# backpack-feedback

[![Build Status](https://travis-ci.org/parabellumKoval/backpack-feedback.svg?branch=master)](https://travis-ci.org/parabellumKoval/backpack-feedback)
[![Coverage Status](https://coveralls.io/repos/github/parabellumKoval/backpack-feedback/badge.svg?branch=master)](https://coveralls.io/github/parabellumKoval/backpack-feedback?branch=master)

[![Packagist](https://img.shields.io/packagist/v/parabellumKoval/backpack-feedback.svg)](https://packagist.org/packages/parabellumKoval/backpack-feedback)
[![Packagist](https://poser.pugx.org/parabellumKoval/backpack-feedback/d/total.svg)](https://packagist.org/packages/parabellumKoval/backpack-feedback)
[![Packagist](https://img.shields.io/packagist/l/parabellumKoval/backpack-feedback.svg)](https://packagist.org/packages/parabellumKoval/backpack-feedback)

This package provides a quick starter kit for implementing reviews for Laravel Backpack. Provides a database, CRUD interface, API routes and more.

## Installation

Install via composer
```bash
composer require parabellumKoval/backpack-feedback
```

Migrate
```bash
php artisan migrate
```

### Publish

#### Configuration File
```bash
php artisan vendor:publish --provider="Backpack\Feedback\ServiceProvider" --tag="config"
```

#### Views File
```bash
php artisan vendor:publish --provider="Backpack\Feedback\ServiceProvider" --tag="views"
```

#### Migrations File
```bash
php artisan vendor:publish --provider="Backpack\Feedback\ServiceProvider" --tag="migrations"
```

#### Routes File
```bash
php artisan vendor:publish --provider="Backpack\Feedback\ServiceProvider" --tag="routes"
```

## Usage

### Seeders
```bash
php artisan db:seed --class="Backpack\Feedback\database\seeders\FeedbackSeeder"
```

## Security

If you discover any security related issues, please email 
instead of using the issue tracker.

## Credits

- [](https://github.com/parabellumKoval/backpack-feedback)
- [All contributors](https://github.com/parabellumKoval/backpack-feedback/graphs/contributors)
