var portfolioApp = angular.module('portfolioApp', ['ui.router']);
portfolioApp.config(function ($stateProvider,$urlRouterProvider) {

    var mainState = {
        name: 'main',
        url: '/',
        template: '<h1>Welcome to my portfolio website!</h1><p>In this website you will find information about me and my projects</p>'
    }

    var portfolioState = {
        name: 'portfolio',
        url: '/portfolio',
        templateUrl: 'app/views/portfolio.html'
    }
    var contactState = {
        name: 'contact',
        url: '/contact',
        templateUrl: 'app/views/contact.html'
    }


    var aboutState = {
        name: 'about',
        url: '/about',
        template: "<h1>About Me</h1><p>I'm a web developer and entrepreneur with 3+ years of experience</p>"
    }

    $stateProvider.state(mainState);
    $stateProvider.state(portfolioState);
    $stateProvider.state(contactState);
    $stateProvider.state(aboutState);
    $urlRouterProvider.otherwise('/');

});
