@props(['item'])

<div class="col-md-6">
    <div class="d-flex gap-3 p-3 rounded hover-shadow">
        @if($item->image)
            <img src="{{ asset('storage/' . $item->image) }}" loading="lazy"
                 alt="{{ $item->name }}" 
                 class="rounded cursor-pointer" 
                 style="width: 80px; height: 80px; object-fit: cover;"
                 data-bs-toggle="modal" 
                 data-bs-target="#imageModal{{ $item->id }}">
        @else
            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                 style="width: 80px; height: 80px;">
                <i class="fas fa-image text-muted"></i>
            </div>
        @endif
        
        <div class="flex-grow-1">
            <div class="d-flex justify-content-between align-items-start mb-1">
                <h6 class="mb-0">{{ $item->name }}</h6>
                <span class="badge bg-gold">${{ number_format($item->price, 0, ',', '.') }}</span>
            </div>
            
            @if($item->description)
                <p class="small text-muted mb-1">
                    {{ Str::limit($item->description, 60) }}
                </p>
            @endif
            
            @if($item->allergens)
                <p class="small text-danger mb-0">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    @if(is_array($item->allergens))
                        {{ implode(', ', $item->allergens) }}
                    @else
                        {{ $item->allergens }}
                    @endif
                </p>
            @endif
            
            @if(!$item->is_available)
                <span class="badge bg-secondary small">No disponible</span>
            @endif
        </div>
    </div>
</div>
