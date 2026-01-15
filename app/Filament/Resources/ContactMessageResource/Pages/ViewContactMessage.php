<?php

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use App\Models\ContactMessage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContactMessage extends ViewRecord
{
    protected static string $resource = ContactMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('reply')
                ->label('Repondre par email')
                ->icon('heroicon-o-envelope')
                ->color('primary')
                ->url(fn (): string => "mailto:{$this->record->email}?subject=Re: {$this->record->subject}")
                ->openUrlInNewTab()
                ->after(function () {
                    $this->record->update(['replied_at' => now()]);
                    $this->record->markAsRead();
                }),
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Mark as read when viewing
        if (!$this->record->is_read) {
            $this->record->markAsRead();
        }

        return $data;
    }
}
