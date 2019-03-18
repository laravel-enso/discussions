# Discussions

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/a6aa6c234c4945379d7c6c143733aa43)](https://www.codacy.com/app/laravel-enso/Discussions?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=laravel-enso/Discussions&amp;utm_campaign=Badge_Grade)
[![StyleCI](https://github.styleci.io/repos/148976842/shield?branch=master)](https://github.styleci.io/repos/148976842)
[![License](https://poser.pugx.org/laravel-enso/discussions/license)](https://packagist.org/packages/laravel-enso/discussions)
[![Total Downloads](https://poser.pugx.org/laravel-enso/discussions/downloads)](https://packagist.org/packages/laravel-enso/discussions)
[![Total Downloads](https://poser.pugx.org/laravel-enso/discussions/downloads)](https://packagist.org/packages/laravel-enso/discussions)
[![Latest Stable Version](https://poser.pugx.org/laravel-enso/discussions/version)](https://packagist.org/packages/laravel-enso/discussions)

Discussions for [Laravel Enso](https://github.com/laravel-enso/Enso).

This package works exclusively within the [Enso](https://github.com/laravel-enso/Enso) ecosystem.

The front end assets that utilize this api are present in the [accessories](https://github.com/enso-ui/accessories) package.

For live examples and demos, you may visit [laravel-enso.com](https://www.laravel-enso.com)

[![Watch the demo](https://laravel-enso.github.io/discussions/screenshots/bulma_001_thumb.png)](https://laravel-enso.github.io/discussions/videos/bulma_discussions.mp4)

<sup>click on the photo to view a short demo in compatible browsers</sup>

## Installation

Comes pre-installed in Enso.

## Features

- discussions are grouped around topics
- users can tag other users in their posts
- the tagged users receive notifications (WIP)
- users can show their appreciation for topics that they like with 'claps'
- powerful what-you-see-is-what-you-get text editor, based on the excellent [Quill](https://quilljs.com/) library
- within Enso, the Discussions module is integrated with the Activity Log
- can be attached to any other model, via a polymorphic relationship
- a `Discussible` trait is available, in order to make it easy to add discussions to a model 
- changes to the discussions and posts are enforced through policies, where changes can be made by the original poster or an administrator
- uses its own suite of specialized Bulma styled VueJS components for smooth integration with the rest of the application  

### Configuration & Usage

Be sure to check out the full documentation for this package available at [docs.laravel-enso.com](https://docs.laravel-enso.com/backend/discussions.html)

### Contributions

are welcome. Pull requests are great, but issues are good too.

### License

This package is released under the MIT license.
