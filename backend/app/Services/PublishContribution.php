<?php

namespace App\Services;

use App\Models\Contribution;
use App\Models\EntityVersion;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class PublishContribution
{
    public function execute(Contribution $contribution, int $userId): Contribution
    {
        if (! in_array($contribution->status, ['community_verified', 'expert_verified'], true)) {
            throw new InvalidArgumentException('Contribution must be verified before publishing.');
        }

        return DB::transaction(function () use ($contribution, $userId) {
            $nextVersion = EntityVersion::where('versionable_type', $contribution->target_type)->where('versionable_id', $contribution->target_id)->max('version') + 1;
            EntityVersion::create(['versionable_type' => $contribution->target_type ?: 'contribution', 'versionable_id' => $contribution->target_id ?: $contribution->id, 'version' => $nextVersion, 'snapshot' => $contribution->change_set, 'created_by' => $userId, 'reason' => $contribution->reason]);
            $contribution->update(['status' => 'published']);
            return $contribution->fresh();
        });
    }
}
