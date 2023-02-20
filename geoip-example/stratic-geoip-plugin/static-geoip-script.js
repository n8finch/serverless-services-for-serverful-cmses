const staticGeoIpHandler = {
    userGeo : {},
    staticGeoIpAPIContent : {},

    init : async () => {
        // Bail early if no divs or staticGeoIp object.
        if( ! staticGeoIpHandler.checkForGeoIpDivs() || {} === staticGeoIpHandler.staticGeoIpAPIContent ) {
            return;
        }

        await staticGeoIpHandler.checkCookie();
        await staticGeoIpHandler.getGeoIpContent();
        await staticGeoIpHandler.replaceDivs();
        await staticGeoIpHandler.removeExtraDivs();

        // Remove extra `geoip-targets` divs
        while( 0 < staticGeoIpHandler.geoIpDivs.length) {
            staticGeoIpHandler.removeExtraDivs();
        }
    },

    checkForGeoIpDivs : () => {
        staticGeoIpHandler.geoIpDivs = document.getElementsByClassName('geoip-targets');
        return (staticGeoIpHandler.geoIpDivs.length > 0)
    },

    getGeoIpContent : async () => {
        const response = await fetch('/wp-json/static-geoip/geoip-content/');
        staticGeoIpHandler.staticGeoIpAPIContent = await response.json();
    },
    
    getGeoIpLocation : async () => {
        const response = await fetch('https://leafy-mochi-7c036e.netlify.app/geolocation');
        staticGeoIpHandler.userGeo = await response.json();
        // Set the cookie for one day.
        staticGeoIpHandler.setGeoCookie('geoIpInfo', JSON.stringify(staticGeoIpHandler.userGeo), 1)
    },

    // Manage GeoIP cookie info
    // Using https://www.w3schools.com/js/js_cookies.asp
    setGeoCookie : (cname, cvalue, exdays) => {
        const d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        let expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    },

    getGeoCookie : (cname) => {
        let name = cname + "=";
        let ca = document.cookie.split(';');
        for(let i = 0; i < ca.length; i++) {
          let c = ca[i];
          while (c.charAt(0) == ' ') {
            c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
          }
        }
        return "";
      },
      
    checkCookie : async () => {
        let geoIp = staticGeoIpHandler.getGeoCookie("geoIpInfo");

        if (geoIp != "" && geoIp !== undefined & geoIp !== 'undefined') {
            staticGeoIpHandler.userGeo = JSON.parse(geoIp);
        } else {
            await staticGeoIpHandler.getGeoIpLocation();
        }
    },

    replaceDivs : () => {
        for( div of staticGeoIpHandler.geoIpDivs ) {
            if( 'country' in staticGeoIpHandler.staticGeoIpAPIContent[div.dataset.id] ) {
                staticGeoIpHandler.countryDivs(div);
            }
            if( 'not_country' in staticGeoIpHandler.staticGeoIpAPIContent[div.dataset.id] ) {
                staticGeoIpHandler.notCountryDivs(div);            
            }
        }
    },


    countryDivs : (div) => {
        if(staticGeoIpHandler.staticGeoIpAPIContent[div.dataset.id]['country'].includes(staticGeoIpHandler.userGeo.geo.country.code)) {
            div.outerHTML = staticGeoIpHandler.staticGeoIpAPIContent[div.dataset.id]['content'];
        }
    },
    
    notCountryDivs : (div) => {
        if(!staticGeoIpHandler.staticGeoIpAPIContent[div.dataset.id]['not_country'].includes(staticGeoIpHandler.userGeo.geo.country.code)) {
            div.outerHTML = staticGeoIpHandler.staticGeoIpAPIContent[div.dataset.id]['content'];
        }
    },

    removeExtraDivs : () => {
        for(div of staticGeoIpHandler.geoIpDivs) {
            div.remove();
        }
    }
}

document.addEventListener("DOMContentLoaded", (event) => { 
    staticGeoIpHandler.init();
});
