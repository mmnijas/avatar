Here’s a complete `README.md` file with all the content grouped together:

````markdown
# Avatar Generator

A simple and customizable avatar generator for PHP that creates PNG images based on user initials. This package uses the Intervention Image library for image manipulation.

## Features

- Generates avatar images with user initials.
- Customizable image size, background color, and text color.
- Uses random dark shades for backgrounds.
- Supports single and double initials.

## Installation

To install the Avatar Generator package, you can include it in your `composer.json` or run the following command:

```bash
composer require mmnijas/avatar
```
````

### Requirements

- PHP 7.2 or higher
- Intervention Image library

You can install the Intervention Image library via Composer:

```bash
composer require intervention/image
```

## Usage

### Route Definition

First, you need to define a route for generating avatars in your `web.php` file:

```php
Route::get('/avatar', [AvatarController::class, 'generateAvatar'])->name('avatar');
```

### Controller Function

In your controller (e.g., `AvatarController`), add the following function:

```php
use Mmnijas\Avatar\Generate;
use Illuminate\Http\Request;

public function generateAvatar(Request $request)
{
    return Generate::avatar($request->all());
}
```

### Displaying the Avatar

You can generate and display an avatar image in your Blade view using the following code:

```html
<img
  src="{{ route('avatar', ['name' => 'Nijas M M', 'size' => 200]) }}"
  alt="Avatar"
/>
```

### Customization Options

You can customize the avatar by passing additional parameters:

- **name**: The full name from which initials will be extracted (default is "John Doe").
- **size**: The size of the avatar image in pixels (default is 200).
- **bg**: Background color in hexadecimal format (optional).
- **color**: Text color in hexadecimal format (optional).

#### Example with Customization

```html
<img
  src="{{ route('avatar', ['name' => 'Nijas M M', 'size' => 200, 'bg' => '#3498db', 'color' => '#ffffff']) }}"
  alt="Avatar"
/>
```

## Example Code

Here’s a complete example of how to set everything up:

1. **Define Route** in `web.php`:

   ```php
   Route::get('/avatar', [AvatarController::class, 'generateAvatar'])->name('avatar');
   ```

2. **Controller Function** in `AvatarController`:

   ```php
   use Mmnijas\Avatar\Generate;
   use Illuminate\Http\Request;

   public function generateAvatar(Request $request)
   {
       return Generate::avatar($request->all());
   }
   ```

3. **Display Avatar** in your Blade view:

   ```html
   <img
     src="{{ route('avatar', ['name' => 'John Doe', 'size' => 150]) }}"
     alt="Avatar"
   />
   ```

## License

This package is open-source software licensed under the MIT License.

## Contributing

If you would like to contribute to this package, feel free to submit a pull request or open an issue.

## Acknowledgments

Thanks to the [Intervention Image](http://image.intervention.io/) library for providing the tools to manipulate images easily.

```

```
