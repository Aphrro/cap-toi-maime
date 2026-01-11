<?php

namespace App\Services;

use App\Models\Professional;
use App\Models\User;
use Illuminate\Support\Collection;

class DuplicateDetectionService
{
    public function findPotentialDuplicateProfessionals(Professional $professional): Collection
    {
        return Professional::where('id', '!=', $professional->id)
            ->where(function ($query) use ($professional) {
                // Same email
                $query->where('email', $professional->email);

                // Or same name + same city
                if ($professional->first_name && $professional->last_name && $professional->city_id) {
                    $query->orWhere(function ($q) use ($professional) {
                        $q->whereRaw('LOWER(first_name) = ?', [strtolower($professional->first_name)])
                          ->whereRaw('LOWER(last_name) = ?', [strtolower($professional->last_name)])
                          ->where('city_id', $professional->city_id);
                    });
                }

                // Or same phone (if provided)
                if ($professional->phone) {
                    $cleanPhone = $this->cleanPhoneNumber($professional->phone);
                    $query->orWhereRaw("REPLACE(REPLACE(phone, ' ', ''), '+', '') LIKE ?", ["%{$cleanPhone}%"]);
                }
            })
            ->get();
    }

    public function findDuplicatesByEmail(string $email): Collection
    {
        $duplicates = collect();

        // Check in users table
        $users = User::where('email', $email)->get();
        if ($users->isNotEmpty()) {
            $duplicates = $duplicates->merge($users->map(fn($u) => [
                'type' => 'user',
                'model' => $u,
                'email' => $u->email,
            ]));
        }

        // Check in professionals table
        $professionals = Professional::where('email', $email)->get();
        if ($professionals->isNotEmpty()) {
            $duplicates = $duplicates->merge($professionals->map(fn($p) => [
                'type' => 'professional',
                'model' => $p,
                'email' => $p->email,
            ]));
        }

        return $duplicates;
    }

    public function findDuplicatesByPhone(string $phone): Collection
    {
        $cleanPhone = $this->cleanPhoneNumber($phone);
        $duplicates = collect();

        // Check in users table
        $users = User::whereNotNull('phone')
            ->whereRaw("REPLACE(REPLACE(phone, ' ', ''), '+', '') LIKE ?", ["%{$cleanPhone}%"])
            ->get();

        if ($users->isNotEmpty()) {
            $duplicates = $duplicates->merge($users->map(fn($u) => [
                'type' => 'user',
                'model' => $u,
                'phone' => $u->phone,
            ]));
        }

        // Check in professionals table
        $professionals = Professional::whereNotNull('phone')
            ->whereRaw("REPLACE(REPLACE(phone, ' ', ''), '+', '') LIKE ?", ["%{$cleanPhone}%"])
            ->get();

        if ($professionals->isNotEmpty()) {
            $duplicates = $duplicates->merge($professionals->map(fn($p) => [
                'type' => 'professional',
                'model' => $p,
                'phone' => $p->phone,
            ]));
        }

        return $duplicates;
    }

    public function getAllPotentialDuplicates(): Collection
    {
        $duplicates = collect();

        // Find professionals with duplicate emails
        $emailDuplicates = Professional::select('email')
            ->whereNotNull('email')
            ->groupBy('email')
            ->havingRaw('COUNT(*) > 1')
            ->pluck('email');

        foreach ($emailDuplicates as $email) {
            $duplicates->push([
                'type' => 'email',
                'value' => $email,
                'professionals' => Professional::where('email', $email)->get(),
            ]);
        }

        // Find professionals with duplicate phone numbers
        $phoneDuplicates = Professional::selectRaw("REPLACE(REPLACE(phone, ' ', ''), '+', '') as clean_phone")
            ->whereNotNull('phone')
            ->where('phone', '!=', '')
            ->groupBy('clean_phone')
            ->havingRaw('COUNT(*) > 1')
            ->pluck('clean_phone');

        foreach ($phoneDuplicates as $phone) {
            $duplicates->push([
                'type' => 'phone',
                'value' => $phone,
                'professionals' => Professional::whereRaw("REPLACE(REPLACE(phone, ' ', ''), '+', '') = ?", [$phone])->get(),
            ]);
        }

        return $duplicates;
    }

    protected function cleanPhoneNumber(string $phone): string
    {
        // Remove spaces, +, and leading zeros
        $cleaned = preg_replace('/[\s\+]/', '', $phone);
        $cleaned = preg_replace('/^0041/', '41', $cleaned);
        $cleaned = preg_replace('/^0/', '41', $cleaned);

        return $cleaned;
    }
}
