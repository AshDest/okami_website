<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('pages.home'))->name('home');
Route::get('/a-propos', fn () => view('pages.about'))->name('about');
Route::get('/services', fn () => view('pages.services'))->name('services');
Route::get('/proprietaires', fn () => view('pages.owners'))->name('owners');
Route::get('/motards', fn () => view('pages.drivers'))->name('drivers');
Route::get('/contact', fn () => view('pages.contact'))->name('contact');
Route::get('/faq', fn () => view('pages.faq'))->name('faq');
