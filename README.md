# Template project for publishing a book in markdown

This is a template project based on the code used to create the PDF and epub version of
_[Discover object-oriented programming using WordPress][1]_. For more a more detailed
writeup of how the code works, please read the companion article [here][2]. You can
also leave your questions there.

_Note: This code is available as a base for your own book project. I'm no longer
doing any development on it._

## Requirements

This is a [Symfony LTS][3] application so you need to have PHP (minimum version 7.1.3) as 
well as [composer][4] installed. Besides that, the application also needs [prince][5] (for 
PDF generation) and [pandoc][6] (for epub generation) installed.

You can install these two tools using [homebrew][7] on MacOS:

```console
$ brew cask install --no-quarantine prince
$ brew install pandoc
```

## Installation

Once the prerequisites installed, you can create a new project using the following 
command:

```console
$ composer create-project carlalexander/book-project-template
```

## Usage

A sample preface + 4 section book layout is available in the `content` directory. The HTML
template used for the book (including the cover) can be found in `book.html.twig`. To edit
the style of the book, edit the CSS files found in the `assets/css` folder.

There are two builds commands available to create your book. One for PDF and one for 
EPUB. These are:

```console
$ bin/console book:build-pdf
$ bin/console book:build-mobile
```

Please refer to this [article][2] for a detailed explanation of the code and how to modify it
to write your own book.

[1]: https://carlalexander.ca/book
[2]: https://carlalexander.ca/write-book-markdown/
[3]: https://symfony.com/
[4]: https://getcomposer.org/
[5]: https://www.princexml.com/
[6]: https://pandoc.org/
[7]: https://brew.sh/
