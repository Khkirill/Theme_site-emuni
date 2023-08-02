<form class="search-form" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" >
    <input type="text" autocomplete="off" id="search-form__input"  class="search-form__input" placeholder="Looking for..." value="<?php get_search_query(); ?>" name="s"  title="Search" max="100" maxLength="100" required/>
    <button class="search-form__submit-button" aria-label="search"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M19.54,17.33l-4.68-4.68c1.06-1.58,1.59-3.55,1.31-5.65C15.69,3.43,12.76,.52,9.19,.07,3.87-.61-.61,3.87,.07,9.19c.45,3.58,3.36,6.51,6.94,6.99,2.1,.28,4.07-.24,5.65-1.31l4.68,4.68c.61,.61,1.6,.61,2.21,0,.61-.61,.61-1.6,0-2.21ZM3.09,8.12c0-2.76,2.24-5,5-5s5,2.24,5,5-2.24,5-5,5-5-2.24-5-5Z"/></svg>
    </button>
    <button class="search-form__close" id="searchClose" aria-label="Button search close"><svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="1" y="1.15088" width="21.5415" height="0.979156" rx="0.489578" transform="rotate(45 1 1.15088)" fill="#333333"/><rect y="16.1509" width="21.5415" height="0.97916" rx="0.48958" transform="rotate(-45 0 16.1509)" fill="#333333"/></svg>
    </button>
</form>