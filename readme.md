# Music Catalog CRUD Code Challenge

### Jacob Sewell

This is a very simple no-auth Laravel app that maintains a list of bands and albums. You should be able to:

- See a tabular listing of all defined bands. (homepage)
- Create, Edit, or Delete a band. (Deleting a band will also delete all of their albums.)
- Go from a band's table row to a tabular listing of all that band's albums.
- See a tabular listing of all defined albums.
- Filter the album listing by band, to show only that band's albums.
- Create, Edit, or Delete an album.

## Goals

I set out here to use Route::resource() and seed with model Factories and Faker, because I haven't had an excuse to do those things before, and I was pleased with the results. If you look in routes/web.php you'll see I still had to do some custom routes to handle filtering (and pagination, if I ever add that), but not having to manually specify the CUD parts of CRUD was nice.

## Areas for Improvement

If I had more time to spend on this and it were meant to be a real product, I'd move all the RESTlike operations into an API and rebuild the frontend as a Vue single page application, because that would handle the filtering and sorting much more cleanly than the current almost-only-php strategy.

Other shortcomings:

- There's no empty text anywhere. If you delete all your bands, or you filter the album listing by a band with no albums, it's just a void.
- No confirmation prompt on patch or delete.
- There should definitely be album art.
- I did essentially no styling, and while the Bootstrap defaults are nice, this could use a polish.
- There's no user authentication, and if there were I'd need to do a little design work (Who has what permissions? Are those permissions global, row-level, or both? Is this one centralized app or something people run their own instances of?).

