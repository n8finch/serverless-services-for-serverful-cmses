# Serverless Services for Serverful CMSes
This is a demo to show some proof of concepts for serverless functions and services integrated with custom WordPress plugins.

These are especially useful for static/serverless sites generated from WordPress.

These proof of concepts were originally developed to work on [Strattic.com](https://strattic.com) sites.

This repo contains the following services (coupled with installable WordPress plugins):
- A GeoIP locator to show or hide content for selected countries
- A breaking news service that doesn't require a new publish every time a custom post type is updated.

## Netlify Functions and Edge Functions
- [Edge Functions Examples](https://edge-functions-examples.netlify.app/)
- [Monorepos on Netlify](https://docs.netlify.com/configure-builds/monorepos/#recommendations-for-specific-setups)
- Integrate with [WPEngine GeoTarget](https://wordpress.org/plugins/wpengine-geoip/)

## Serverless Framework and AWS
- [Serverless.yml Reference](https://www.serverless.com/framework/docs/providers/aws/guide/serverless.yml)
- [AWS Lambda Functions Reference](https://www.serverless.com/framework/docs/providers/aws/guide/functions#lambda-function-urls)
