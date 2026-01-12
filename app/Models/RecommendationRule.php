<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class RecommendationRule extends Model
{
    protected $fillable = [
        'name',
        'trigger_context',
        'conditions',
        'recommendation_type',
        'recommendation_data',
        'priority',
        'is_active',
        'times_shown',
        'times_clicked',
    ];

    protected $casts = [
        'conditions' => 'array',
        'recommendation_data' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeForContext(Builder $query, string $context): Builder
    {
        return $query->where('trigger_context', $context);
    }

    public function scopeByPriority(Builder $query): Builder
    {
        return $query->orderByDesc('priority');
    }

    public function incrementShown(): void
    {
        $this->increment('times_shown');
    }

    public function incrementClicked(): void
    {
        $this->increment('times_clicked');
    }

    public function getClickThroughRate(): float
    {
        if ($this->times_shown === 0) {
            return 0;
        }

        return round(($this->times_clicked / $this->times_shown) * 100, 2);
    }

    public function evaluateConditions(array $context): bool
    {
        foreach ($this->conditions as $field => $condition) {
            if (!$this->evaluateCondition($field, $condition, $context)) {
                return false;
            }
        }

        return true;
    }

    protected function evaluateCondition(string $field, array $condition, array $context): bool
    {
        $operator = $condition[0] ?? '=';
        $value = $condition[1] ?? null;
        $contextValue = $context[$field] ?? null;

        return match ($operator) {
            '=' => $contextValue === $value,
            '!=' => $contextValue !== $value,
            '>' => is_numeric($contextValue) && $contextValue > $value,
            '>=' => is_numeric($contextValue) && $contextValue >= $value,
            '<' => is_numeric($contextValue) && $contextValue < $value,
            '<=' => is_numeric($contextValue) && $contextValue <= $value,
            'contains' => is_array($contextValue) && in_array($value, $contextValue),
            'not_contains' => is_array($contextValue) && !in_array($value, $contextValue),
            'in' => is_array($value) && in_array($contextValue, $value),
            'not_in' => is_array($value) && !in_array($contextValue, $value),
            'exists' => $contextValue !== null,
            'not_exists' => $contextValue === null,
            default => false,
        };
    }
}
