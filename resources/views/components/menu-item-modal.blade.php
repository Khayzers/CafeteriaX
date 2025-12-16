@props(['item'])

@if($item->image)
    <div class="modal fade" id="imageModal{{ $item->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" style="background: white; border: 2px solid #D4AF37;">
                <div class="modal-header" style="background: linear-gradient(135deg, #D4AF37 0%, #E5C158 100%); border-bottom: none;">
                    <h5 class="modal-title text-white fw-bold" id="imageModalLabel{{ $item->id }}">
                        <i class="fas fa-utensils me-2"></i>{{ $item->name }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-4">
                        <div class="col-md-7">
                            <img src="{{ asset('storage/' . $item->image) }}" loading="lazy"
                                 alt="{{ $item->name }}" 
                                 class="img-fluid rounded shadow-lg"
                                 style="width: 100%; height: auto; max-height: 500px; object-fit: contain;">
                        </div>
                        <div class="col-md-5">
                            <div class="h-100 d-flex flex-column">
                                <div class="mb-3">
                                    <span class="badge bg-gold fs-4 px-3 py-2">
                                        ${{ number_format($item->price, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <small class="text-gold">
                                        <i class="fas fa-tag me-2"></i>{{ $item->category->emoji ?? '' }} {{ $item->category->name }}
                                    </small>
                                </div>

                                @if($item->description)
                                    <div class="mb-3">
                                        <h6 class="text-gold mb-2">
                                            <i class="fas fa-info-circle me-2"></i>Descripción
                                        </h6>
                                        <p class="text-dark mb-0">{{ $item->description }}</p>
                                    </div>
                                @endif

                                @if($item->preparation_time)
                                    <div class="mb-3">
                                        <small class="text-dark">
                                            <i class="fas fa-clock text-gold me-2"></i>Tiempo de preparación: {{ $item->preparation_time }} minutos
                                        </small>
                                    </div>
                                @endif

                                @if($item->allergens)
                                    <div class="mb-3">
                                        <h6 class="text-danger mb-2">
                                            <i class="fas fa-exclamation-triangle me-2"></i>Alérgenos
                                        </h6>
                                        <div class="d-flex flex-wrap gap-2">
                                            @if(is_array($item->allergens))
                                                @foreach($item->allergens as $allergen)
                                                    <span class="badge bg-danger">{{ $allergen }}</span>
                                                @endforeach
                                            @else
                                                <span class="badge bg-danger">{{ $item->allergens }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <div class="mt-auto">
                                    @if($item->is_available)
                                        <span class="badge bg-success fs-6 px-3 py-2">
                                            <i class="fas fa-check-circle me-2"></i>Disponible
                                        </span>
                                    @else
                                        <span class="badge bg-secondary fs-6 px-3 py-2">
                                            <i class="fas fa-times-circle me-2"></i>No disponible
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
