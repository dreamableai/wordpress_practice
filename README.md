# BlogKit - Advanced Blog Elements for Elementor

BlogKit is a powerful WordPress plugin that extends Elementor with advanced blog widgets and features. Create stunning blog layouts with various styles and customization options.

## This README.md includes:
1. Overview of the plugin
2. Key features
3. System requirements
4. Installation instructions
5. Usage guide
6. Development information
7. Project structure
8. Contributing guidelines
9. License information
10. Support details
11. Credits


## Features

- **Blog Classic Grid Widget**: Create beautiful blog grids with customizable layouts
- **Customizable Post Layouts**: Flexible design options for your blog posts
- **Advanced Styling Options**: Comprehensive styling controls for every element
- **Post Format Support**: Compatible with all WordPress post formats
- **Responsive Design**: Perfect display across all devices
- **Easy to Use Interface**: Seamless integration with Elementor

## Requirements

- WordPress 5.8 or higher
- PHP 8.0 or higher
- Elementor 3.19.0 or higher

## Installation

1. Upload the plugin files to the `/wp-content/plugins/blogkit` directory, or install the plugin through the WordPress plugins screen directly
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the BlogKit widgets in Elementor editor

## Usage

### Blog Classic Grid Widget

The Blog Classic Grid widget offers:
- 2-4 columns grid layout options
- Customizable colors and typography
- Post meta information controls
- Support for all post formats
- Responsive design settings

## Development

### Build Commands

```bash
# Install production dependencies
npm run install-prod

# Clean up system files
npm run clean

# Generate translation template
npm run make-pot

# Create distribution bundle
npm run bundle

blogkit/
├── Admin/
├── Frontend/
│   ├── Elementor/
│   │   ├── Assets/
│   │   └── Widgets/
│   └── Frontend.php
├── Inc/
├── languages/
└── vendor/