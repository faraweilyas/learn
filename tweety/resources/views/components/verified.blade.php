@if ($user->isVerified())
    <img
        style='width: 20px; display: inline; margin-bottom: 3px;'
        src="{{ pc_asset("/images/verified-badge.png") }}"
        alt="{{ $user->name }}"
    />
@endif
