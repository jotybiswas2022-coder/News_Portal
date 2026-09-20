{{--
    Reusable product card.
    Expects $card (array) with:
      name, category, price, url, image,
      old_price (optional), badge (optional, e.g. "New" / "20% Off"),
      badge_style (optional: 'gold'), in_cart (optional bool),
      sold_out (optional bool)
--}}
<article class="product-card reveal">
    @if(!empty($card['badge']))
        <span class="product-card__badge {{ ($card['badge_style'] ?? '') === 'gold' ? 'product-card__badge--gold' : '' }}">
            {{ $card['badge'] }}
        </span>
    @endif

    <div class="product-card__frame">
        <a class="product-card__media" href="{{ $card['url'] }}"
           aria-label="{{ $card['name'] }}">
            <img src="{{ $card['image'] }}"
                 alt="{{ $card['name'] }} — {{ $card['category'] }}"
                 loading="lazy">
        </a>
    </div>

    <div class="product-card__info">
        <span class="product-card__category">{{ $card['category'] }}</span>

        <h3 class="product-card__name">
            <a href="{{ $card['url'] }}">{{ $card['name'] }}</a>
        </h3>

        <p class="product-card__price">
            @if(!empty($card['old_price']))
                <s>{{ $card['old_price'] }}</s>
            @endif
            <span>{{ $card['price'] }}</span>
        </p>
    </div>

    <div class="product-card__cta">
        <a class="btn btn--block" href="{{ $card['url'] }}">
            @if(!empty($card['sold_out']))
                Sold Out
            @elseif(!empty($card['in_cart']))
                In Bag
            @else
                Add to Bag
            @endif
        </a>
    </div>
</article>
