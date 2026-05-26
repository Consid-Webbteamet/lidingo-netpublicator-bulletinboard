# Lidingo Netpublicator Bulletinboard

WordPress plugin that renders the Netpublicator public bulletin board as a Gutenberg block.

## Usage

1. Activate the plugin.
2. Add the Netpublicator key under Settings > Anslagstavla.
3. Add the "Anslagstavla" block to a page.

The block renders nothing if the Netpublicator key is missing. The implementation supports one bulletin board per page because the Netpublicator vendor script uses fixed DOM ids.

## CSP

Allow `https://www.netpublicator.com` in the site's CSP configuration when needed.
