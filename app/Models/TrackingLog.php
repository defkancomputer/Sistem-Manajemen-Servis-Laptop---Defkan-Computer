<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrackingLog extends Model
{
    /**
     * Indicates if the model should be timestamped.
     * We only use created_at, not updated_at
     */
    public $timestamps = false;

    protected $fillable = [
        'servis_id',
        'nomor_servis',
        'ip_address',
        'user_agent',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Get the servis associated with this log
     */
    public function servis(): BelongsTo
    {
        return $this->belongsTo(Servis::class);
    }

    /**
     * Get browser name from user agent
     */
    public function getBrowserName(): string
    {
        $userAgent = $this->user_agent ?? '';
        
        if (str_contains($userAgent, 'Chrome')) {
            return 'Chrome';
        } elseif (str_contains($userAgent, 'Firefox')) {
            return 'Firefox';
        } elseif (str_contains($userAgent, 'Safari')) {
            return 'Safari';
        } elseif (str_contains($userAgent, 'Edge')) {
            return 'Edge';
        } elseif (str_contains($userAgent, 'Opera')) {
            return 'Opera';
        }
        
        return 'Unknown';
    }

    /**
     * Get device type from user agent
     */
    public function getDeviceType(): string
    {
        $userAgent = $this->user_agent ?? '';
        
        if (str_contains($userAgent, 'Mobile') || str_contains($userAgent, 'Android')) {
            return 'Mobile';
        } elseif (str_contains($userAgent, 'Tablet') || str_contains($userAgent, 'iPad')) {
            return 'Tablet';
        }
        
        return 'Desktop';
    }
}
