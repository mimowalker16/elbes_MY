@php
$icons = [
    'home' => '<span class="material-symbols-rounded" style="font-size:22px;">home</span>',
    'shop' => '<span class="material-symbols-rounded" style="font-size:22px;">storefront</span>',
    'cart' => '<span class="material-symbols-rounded" style="font-size:22px;">shopping_cart</span>',
    'profile' => '<span class="material-symbols-rounded" style="font-size:22px;">account_circle</span>',
    'orders' => '<span class="material-symbols-rounded" style="font-size:22px;">receipt_long</span>',
    'events' => '<span class="material-symbols-rounded" style="font-size:22px;">event</span>',
    'admin' => '<span class="material-symbols-rounded" style="font-size:22px;">admin_panel_settings</span>',
    'products' => '<span class="material-symbols-rounded" style="font-size:22px;">inventory_2</span>',
    'logout' => '<span class="material-symbols-rounded" style="font-size:22px;color:#dc3545;">logout</span>',
    'pending-events' => '<span class="material-symbols-rounded" style="font-size:22px;">pending_actions</span>',
    'event-create-it' => '<span class="material-symbols-rounded" style="font-size:22px;">add_circle</span>',
];
echo $icons[$icon] ?? '';
@endphp
