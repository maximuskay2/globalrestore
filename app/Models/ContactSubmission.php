<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    public const INVOLVEMENT_VOLUNTEER = 'volunteer';

    public const INVOLVEMENT_PARTNER = 'partner';

    public const INVOLVEMENT_SUPPORT = 'support';

    public static function involvementOptions(): array
    {
        return [
            self::INVOLVEMENT_VOLUNTEER => 'I want to Volunteer',
            self::INVOLVEMENT_PARTNER => 'I want to Partner',
            self::INVOLVEMENT_SUPPORT => 'I am looking for support/services',
        ];
    }

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'involvement_type',
        'is_read',
    ];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
        ];
    }

    public function involvementLabel(): string
    {
        return self::involvementOptions()[$this->involvement_type] ?? $this->involvement_type;
    }
}
