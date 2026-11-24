<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model; use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Payment extends Model { protected $fillable=['receipt_number','membership_transaction_id','amount','payment_method','paid_at','notes','received_by']; protected function casts(): array { return ['amount'=>'decimal:2','paid_at'=>'datetime']; } public function transaction(): BelongsTo { return $this->belongsTo(MembershipTransaction::class,'membership_transaction_id'); } }
