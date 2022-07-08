<form action="{{ route('clientProductSearch') }}" class="search" method="GET">
  <input class="search__input" type="search" placeholder="Search" id="searchInput" name="product" onfocus="Onfocus(this)" onblur="Onblur(this)">
  <div class="search__icon-container">
    <label for="searchInput" class="search__label" aria-label="Search">
      <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M28 28L21.8613 21.8503L28 28ZM25.2632 13.6316C25.2632 16.7165 24.0377 19.675 21.8563 21.8563C19.675 24.0377 16.7165 25.2632 13.6316 25.2632C10.5467 25.2632 7.58816 24.0377 5.40681 21.8563C3.22547 19.675 2 16.7165 2 13.6316C2 10.5467 3.22547 7.58816 5.40681 5.40681C7.58816 3.22547 10.5467 2 13.6316 2C16.7165 2 19.675 3.22547 21.8563 5.40681C24.0377 7.58816 25.2632 10.5467 25.2632 13.6316V13.6316Z" stroke="black" stroke-opacity="0.8" stroke-width="2.5" stroke-linecap="round"/>
        </svg>
    </label>
    <button class="search__submit" aria-label="Search">
      <svg viewBox="0 0 1000 1000" title="Search"><path fill="currentColor" d="M408 745a337 337 0 1 0 0-674 337 337 0 0 0 0 674zm239-19a396 396 0 0 1-239 80 398 398 0 1 1 319-159l247 248a56 56 0 0 1 0 79 56 56 0 0 1-79 0L647 726z"/></svg>
    </button>
  </div>
</form>
<a href="{{ route('clientCarts') }}" class="text-decoration-none">
  <div class="cart">
    <span class="badge bg-dark count" id="cartCount">{{ count((array) session('cart')) }}</span>
    <i class="bi bi-cart2 mt-2"></i>
  </div>
</a>