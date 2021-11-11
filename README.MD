### Media manager

This package can process images through the Imagic library with a custom configs.

####Dependencies: 
`php 7.4`,
`intervention/image`,
`laravel/framework`,
`league/flysystem`,
`ramsey/uuid`.

####Installation:

1. Register `MediaManager\Providers\ServiceProvider::class` in app.php in providers.
2. Init `vendor:publish MediaManager` for publishing media.php config file, then restore application config caches.

####Example of usage: 

Class `ImageMediaService` has a couple of methods for processing images:
1. `upload(configurator, model, file);`
2. `delete(configurator, model);

####Helpers: 

`PathHelper::class` can prepare full path according the image model.

