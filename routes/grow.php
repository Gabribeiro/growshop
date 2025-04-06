Route::post('/carrinho/adicionar', [GrowController::class, 'addToCart'])->name('grow.cart.add');
Route::post('/carrinho/remover', [GrowController::class, 'removeFromCart'])->name('grow.cart.remove');
Route::post('/carrinho/atualizar', [GrowController::class, 'updateCart'])->name('grow.cart.update');
Route::get('/carrinho', [GrowController::class, 'cart'])->name('grow.cart');
Route::get('/checkout', [GrowController::class, 'checkout'])->name('grow.checkout'); 