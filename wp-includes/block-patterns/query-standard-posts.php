<?php
/**
 * Query: Standard.
 *
 * @package WordPress
 */

return [
    "title" => _x("Standard", "Block pattern title"),
    "blockTypes" => ["core/query"],
    "categories" => ["query"],
    "content" => '<!-- wp:query {"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
					<div class="wp-block-query">
					<!-- wp:post-template -->
					<!-- wp:post-title {"isLink":true} /-->
					<!-- wp:post-featured-image  {"isLink":true,"align":"wide"} /-->
					<!-- wp:post-excerpt /-->
					<!-- wp:separator -->
					<hr class="wp-block-separator"/>
					<!-- /wp:separator -->
					<!-- wp:post-date /-->
					<!-- /wp:post-template -->
					</div>
					<!-- /wp:query -->',
];
