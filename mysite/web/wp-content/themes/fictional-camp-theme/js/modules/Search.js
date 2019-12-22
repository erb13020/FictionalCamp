import $ from 'jquery';

class Search {
  // 1. describe and create/initiate our object
  constructor() {
  	this.addSearchHTML();
  	this.results = $("#search-overlay__results");
    this.openButton = $(".js-search-trigger");
    this.closeButton = $(".search-overlay__close");
    this.searchOverlay = $(".search-overlay");
    this.searchField = $("#search-term");
    this.events();
    this.overlayOpen = false;
    this.isSpinnerVisible = false;
    this.previousValue;
    this.typingTimer;
  }

  // 2. events
  events() {
    this.openButton.on("click", this.openOverlay.bind(this));
    this.closeButton.on("click", this.closeOverlay.bind(this));
    $(document).on("keydown", this.keyPressDispatcher.bind(this));
    this.searchField.on("keyup", this.typingLogic.bind(this));
  }
  

  // 3. methods (function, action...)



  openOverlay() {
    this.searchOverlay.addClass("search-overlay--active");
    $("body").addClass("body-no-scroll");
    this.searchField.val(``);
    this.results.html(``);
    setTimeout(() => this.searchField.focus(), 301);
    this.overlayOpen = true;
  }

  closeOverlay() {
    this.searchOverlay.removeClass("search-overlay--active");
    $("body").removeClass("body-no-scroll");
    this.overlayOpen = false;
  }

  keyPressDispatcher(e) {
	if (e.keyCode == 83 && !this.overlayOpen && !$("input, textarea").is(':focus')) {
		this.openOverlay();
	} else if (e.keyCode == 27 && this.overlayOpen) {
		this.closeOverlay();
	}
  }

  typingLogic() {
  	if (this.searchField.val() != this.previousValue) {
  		clearTimeout(this.typingTimer);

  		if (this.searchField.val()) {
  			if (!this.isSpinnerVisible) {
  				this.results.html('<div class="spinner-loader"></div>');
  				this.isSpinnerVisible = true;
  		}
  	this.typingTimer = setTimeout(this.getResults.bind(this), 250);
  		} else {
  			this.results.html('');
  			this.isSpinnerVisible = false;
  		}
  	
  	}	
  	this.previousValue = this.searchField.val();
  }

  getResults() {
  	$.getJSON(campData.root_url + '/wp-json/camp/v1/search?term=' + this.searchField.val(), (results) => {
  		this.results.html(`
  			<div class="row">
  				<div class="one-third">
  					<h2 class="search-overlay__section-title">General Information</h2>
	  				${results.generalInfo.length ? '<ul class="link-list min-list">' : '<p>No general information matches your search</p>'}
	  					${results.generalInfo.map(item =>  `<li><a href="${item.permalink}">${item.title}</a> ${item.postType == 'post' ? `by ${item.authorName}` : ''} </li>`).join('')}
	  				${results.generalInfo.length ? '</ul>' : ''}
  				</div>

  				<div class="one-third">
		            <h2 class="search-overlay__section-title">Events</h2>
		            ${results.events.length ? '' : `<p>No events match that search. <a href="${campData.root_url}/events">View all events</a></p>`}
		              ${results.events.map(item => `
		                <div class="event-summary">
		                  <a class="event-summary__date t-center" href="${item.permalink}">
		                    <span class="event-summary__month">${item.month}</span>
		                    <span class="event-summary__day">${item.day}</span>  
		                  </a>
		                  <div class="event-summary__content">
		                    <h5 class="event-summary__title headline headline--tiny"><a href="${item.permalink}">${item.title}</a></h5>
		                    <p>${item.description} <a href="${item.permalink}" class="nu gray">Learn more</a></p>
		                  </div>
		                </div>
		              `).join('')}
  				</div>

  				<div class="one-third">

		            <h2 class="search-overlay__section-title">Activities</h2>
		            ${results.activities.length ? '<div class="col-search">' : `<p>No activities match that search. <a href="${campData.root_url}/activity">View all activities</a> </p>`}
		              ${results.activities.map(item => `
						  <div class="u-dib search_thumb">
						    <div class="activity-thumb u-ma">
						      <a href="${item.permalink}"><img src="${item.image}"></a>
						    </div>
						        <h5 class="activity-summary__title headline headline--tiny u-tac u-mtt"><a href="${item.permalink}">${item.title}</a></h5>
						  </div>
		              `).join('')}
		            ${results.activities.length ? '</div>' : ''}

		            <h2 class="search-overlay__section-title">Counselors</h2>
		            ${results.counselors.length ? '<div class="col-search">' : `<p>No counselors match that search. <a href="${campData.root_url}/counselors">View all counselors</a> </p>`}
		              ${results.counselors.map(item => `
						  <div class="u-dib search_thumb">
						    <div class="activity-thumb u-ma">
						      <a href="${item.permalink}"><img src="${item.image}"></a>
						    </div>
						        <h5 class="activity-summary__title headline headline--tiny u-tac u-mtt"><a href="${item.permalink}">${item.title}</a></h5>
						  </div>
		              `).join('')}
		            ${results.counselors.length ? '</div>' : ''}


  				</div>

  			</div>
  		`);
  		this.isSpinnerVisible = false;
  	});
  }

  addSearchHTML() {
  	$('body').append(`
  	<div class="search-overlay">
	    <div class="search-overlay__top">
	      <div class="container">
	        <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
	        <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">
	        <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
	      </div>
	    </div>

    <div class="container">
      <div id="search-overlay__results"></div>
  	</div>
  	`);
  }

}

export default Search;