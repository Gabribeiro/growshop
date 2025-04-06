<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Event;
// use App\Models\Font;
use App\Models\Material;
use App\Models\Product;
use App\Models\Shape;
use App\Models\Size;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function showAllProducts(Product $product)
    {
        $types = Type::all();
        $product = Product::where('name', 'NOT LIKE', '%Try Before Buy%')
            ->where('name', 'NOT LIKE', '%Try Before Buy%')->paginate(15);
        return view('products', ['products' => $product, 'title' => "Produtos", 'types' => $types]);
    }

    public function showProductsByType($type)
    {
        $term = str_replace('-', ' ', ucwords($type, '-'));
        $types = Type::all();

        $collection = Product::where('flower_type', '=', $term)
            ->where('name', 'NOT LIKE', '%Try Before Buy%')
            ->where('name', 'NOT LIKE', '%Try Before Buy%')->paginate(15);
        return view('products', ['products' => $collection, 'title' => $term, 'types' => $types]);
    }

    public function showProductsByShape($shape)
    {
        $term = ucwords((str_replace('-', ' ', $shape)));
        $typeid = Shape::search($term)->get()->value('id');
        $types = Type::all();
        
        $collection = Shape::find($typeid)->products()
            ->where('name', 'NOT LIKE', '%Try Before Buy%')
            ->where('name', 'NOT LIKE', '%Try Before Buy%')->paginate(15);
        return view('products', ['products' => $collection, 'title' => $term, 'types' => $types]);
    }

    public function showProductsBySize($size)
    {
        $term = ucwords((str_replace('-', ' ', $size)));
        $typeid = Size::search($term)->get()->value('id');
        $types = Type::all();
        
        $collection = Size::find($typeid)->products()
            ->where('name', 'NOT LIKE', '%Try Before Buy%')->paginate(15);
        return view('products', ['products' => $collection, 'title' => $term, 'types' => $types]);
    }

    public function showProductsByMaterial($material)
    {
        $term = ucwords((str_replace('-', ' ', $material)));
        $typeid = Material::search($term)->get()->value('id');
        $types = Type::all();
        
        $collection = Material::find($typeid)->products()
            ->where('name', 'NOT LIKE', '%Try Before Buy%')->paginate(15);
        return view('products', ['products' => $collection, 'title' => $term, 'types' => $types]);
    }

    public function showProductsByEvent($event)
    {
        $term = ucwords((str_replace('-', ' ', $event)));
        $typeid = Event::search($term)->get()->value('id');
        $types = Type::all();
        
        $collection = Event::find($typeid)->products()
            ->where('name', 'NOT LIKE', '%Try Before Buy%')->paginate(15);
        return view('products', ['products' => $collection, 'title' => $term, 'types' => $types]);
    }

    public function search(Request $request)
    {
        $incomingField = $request->validate([
            'term' => 'required'
        ]);

        $term = $incomingField['term'];

        $products = Product::where('products.name', 'LIKE', "%$term%")
            ->orWhereHas('events', function ($query) use ($term) {
                $query->where('events.name', 'LIKE', "%$term%");
            })
            ->get();

        return view('search', ['products' => $products, 'term' => $term]);
    }

    public function detailProduct(Product $product)
    {
        $eachcolor = json_decode($product->eachcolor_image ?? '{}');
        $sel_colors = array();
        
        if($eachcolor) {
            foreach ($eachcolor as $key => $value) {
                $col = DB::table('colors')->where('id', '=', $key)->get()->toArray();
                if(count($col) > 0) {
                    $sel_colors[] = $col[0];
                }
            }
        }
        
        // Buscar produtos relacionados
        $relatedProducts = Product::where('flower_type', $product->flower_type)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();
            
        return view('single-product', [
            'product' => $product, 
            'sel_colors' => $sel_colors, 
            'relatedProducts' => $relatedProducts
        ]);
    }


    public function filterAscending(Request $request)
    {
        // Pega os valores dos parâmetros
        $isDesign = filter_var($request->input('isDesign'));
        $event = filter_var($request->input('event'));
        $productType = filter_var($request->input('type'));
        $size = filter_var($request->input('size'));
        $shape = filter_var($request->input('shape'));
        $material = filter_var($request->input('material'));

        // Criação da query de ordenação crescente pelo nome do produto
        $query = Product::orderBy('name', "ASC");

        // Filtro para 'event' - apenas se o valor for fornecido
        if ($event) {
            $formattedEvent = ucwords(str_replace('-', ' ', strtolower($event)));
            $query->whereHas('events', function ($query) use ($formattedEvent) {
                $query->where('name', '=', $formattedEvent);
            });
        }

        // Filtro para 'product_type' - apenas se o valor for fornecido
        if ($productType != null) {
            // Substitui hífens por espaços e capitaliza a primeira letra de cada palavra
            $formattedProductType = ucwords(str_replace('-', ' ', strtolower($productType)));
            $query->where('flower_type', '=', $formattedProductType);
        }

        // Filtro para 'size' - apenas se o valor for fornecido
        if ($size) {
            $formattedSize = ucwords(str_replace('-', ' ', strtolower($size)));
            $query->whereHas('sizes', function ($query) use ($formattedSize) {
                $query->where('name', '=', $formattedSize);
            });
        }

        // Filtro para 'shape' - apenas se o valor for fornecido
        if ($shape) {
            $formattedShape = ucwords(str_replace('-', ' ', strtolower($shape)));
            $query->whereHas('shapes', function ($query) use ($formattedShape) {
                $query->where('name', '=', $formattedShape);
            });
        }

        // Filtro para 'material' - apenas se o valor for fornecido
        if ($material) {
            $formattedMaterial = ucwords(str_replace('-', ' ', strtolower($material)));
            $query->whereHas('materials', function ($query) use ($formattedMaterial) {
                $query->where('name', '=', $formattedMaterial == 'Acrylic Clear Box' ? 'Acrylic Clear Box' : ($formattedMaterial == 'Long Stem Box' ? 'Long Stem Box' : ($formattedMaterial == 'Long Box' ? 'Long Box' : 'Unknown Material')));
            });
        }


        // Aplicando o filtro de design
        if ($isDesign == 'true') {
            $query->where('name', 'LIKE', '%Try Before Buy%');
        } else {
            $query->where('name', 'NOT LIKE', '%Try Before Buy%');
        }


        // Executando a query e recuperando os produtos
        $product = $query->get();

        // Retornando a resposta JSON com os resultados filtrados
        return response()->json([
            'theHTML' => view('products-only', ['products' => $product])->render()
        ]);
    }

    public function filterDescending(Request $request)
    {
        // Pega os valores dos parâmetros
        $isDesign = filter_var($request->input('isDesign'));
        $event = filter_var($request->input('event'));
        $productType = filter_var($request->input('type'));
        $size = filter_var($request->input('size'));
        $shape = filter_var($request->input('shape'));
        $material = filter_var($request->input('material'));

        // Criação da query de ordenação decrescente pelo nome do produto
        $query = Product::orderBy('name', "DESC");

        // Aplicando o filtro de design
        if ($isDesign == 'true') {
            $query->where('name', 'LIKE', '%Try Before Buy%');
        } else {
            $query->where('name', 'NOT LIKE', '%Try Before Buy%');
        }

        // Filtro para 'event' - apenas se o valor for fornecido
        if ($event) {
            $formattedEvent = ucwords(str_replace('-', ' ', strtolower($event)));
            $query->whereHas('events', function ($query) use ($formattedEvent) {
                $query->where('name', '=', $formattedEvent);
            });
        }

        // Filtro para 'product_type' - apenas se o valor for fornecido
        if ($productType != null) {
            // Substitui hífens por espaços e capitaliza a primeira letra de cada palavra
            $formattedProductType = ucwords(str_replace('-', ' ', strtolower($productType)));
            $query->where('flower_type', '=', $formattedProductType);
        }

        // Filtro para 'size' - apenas se o valor for fornecido
        if ($size) {
            $formattedSize = ucwords(str_replace('-', ' ', strtolower($size)));
            $query->whereHas('sizes', function ($query) use ($formattedSize) {
                $query->where('name', '=', $formattedSize);
            });
        }

        // Filtro para 'shape' - apenas se o valor for fornecido
        if ($shape) {
            $formattedShape = ucwords(str_replace('-', ' ', strtolower($shape)));
            $query->whereHas('shapes', function ($query) use ($formattedShape) {
                $query->where('name', '=', $formattedShape);
            });
        }

        // Filtro para 'material' - apenas se o valor for fornecido
        if ($material) {
            // Formata o valor do material substituindo hífens por espaços e capitalizando
            $formattedMaterial = ucwords(str_replace('-', ' ', strtolower($material)));

            // Aplica o filtro de material com o valor formatado
            $query->whereHas('materials', function ($query) use ($formattedMaterial) {
                $query->where('name', '=', $formattedMaterial);
            });
        }



        // Executando a query e recuperando os produtos
        $product = $query->get();

        // Retornando a resposta JSON com os resultados filtrados
        return response()->json([
            'theHTML' => view('products-only', ['products' => $product])->render()
        ]);
    }


    public function filterFeatured(Request $request)
    {
        $isDesign = $request->input('isDesign');
        $event = filter_var($request->input('event'));
        $productType = filter_var($request->input('type'));
        $size = filter_var($request->input('size'));
        $shape = filter_var($request->input('shape'));
        $material = filter_var($request->input('material'));

        $query = Product::orderBy('price', "DESC");

        // Aplicando filtro de Design221r
        if ($isDesign == 'true') {
            $query->where('name', 'LIKE', '%Try Before Buy%');
        } else {
            $query->where('name', 'NOT LIKE', '%Try Before Buy%');
        }

        // Filtro para 'event' - apenas se o valor for fornecido
        if ($event) {
            $formattedEvent = ucwords(str_replace('-', ' ', strtolower($event)));
            $query->whereHas('events', function ($query) use ($formattedEvent) {
                $query->where('name', '=', $formattedEvent);
            });
        }

        // Filtro para 'product_type' - apenas se o valor for fornecido
        if ($productType != null) {
            // Substitui hífens por espaços e capitaliza a primeira letra de cada palavra
            $formattedProductType = ucwords(str_replace('-', ' ', strtolower($productType)));
            $query->where('flower_type', '=', $formattedProductType);
        }

        // Filtro para 'size' - apenas se o valor for fornecido
        if ($size) {
            $formattedSize = ucwords(str_replace('-', ' ', strtolower($size)));
            $query->whereHas('sizes', function ($query) use ($formattedSize) {
                $query->where('name', '=', $formattedSize);
            });
        }

        // Filtro para 'shape' - apenas se o valor for fornecido
        if ($shape) {
            $formattedShape = ucwords(str_replace('-', ' ', strtolower($shape)));
            $query->whereHas('shapes', function ($query) use ($formattedShape) {
                $query->where('name', '=', $formattedShape);
            });
        }

        // Filtro para 'material' - apenas se o valor for fornecido
        if ($material) {
            // Formata o valor do material substituindo hífens por espaços e capitalizando
            $formattedMaterial = ucwords(str_replace('-', ' ', strtolower($material)));

            // Aplica o filtro de material com o valor formatado
            $query->whereHas('materials', function ($query) use ($formattedMaterial) {
                $query->where('name', '=', $formattedMaterial);
            });
        }



        $product = $query->get();
        return response()->json([
            'theHTML' => view('products-only', ['products' => $product])->render()
        ]);
    }

    public function filterBestSelling(Request $request)
    {
        $isDesign = $request->input('isDesign');
        $event = filter_var($request->input('event'));
        $productType = filter_var($request->input('type'));
        $size = filter_var($request->input('size'));
        $shape = filter_var($request->input('shape'));
        $material = filter_var($request->input('material'));

        $query = Product::orderBy('sold_amount', "DESC");

        if ($isDesign == 'true') {
            $query->where('name', 'LIKE', '%Try Before Buy%');
        } else {
            $query->where('name', 'NOT LIKE', '%Try Before Buy%');
        }

        // Filtro para 'event' - apenas se o valor for fornecido
        // Filtro para 'event' - apenas se o valor for fornecido
        if ($event) {
            $formattedEvent = ucwords(str_replace('-', ' ', strtolower($event)));
            $query->whereHas('events', function ($query) use ($formattedEvent) {
                $query->where('name', '=', $formattedEvent);
            });
        }

        // Filtro para 'product_type' - apenas se o valor for fornecido
        if ($productType != null) {
            // Substitui hífens por espaços e capitaliza a primeira letra de cada palavra
            $formattedProductType = ucwords(str_replace('-', ' ', strtolower($productType)));
            $query->where('flower_type', '=', $formattedProductType);
        }

        // Filtro para 'size' - apenas se o valor for fornecido
        if ($size) {
            $formattedSize = ucwords(str_replace('-', ' ', strtolower($size)));
            $query->whereHas('sizes', function ($query) use ($formattedSize) {
                $query->where('name', '=', $formattedSize);
            });
        }

        // Filtro para 'shape' - apenas se o valor for fornecido
        if ($shape) {
            $formattedShape = ucwords(str_replace('-', ' ', strtolower($shape)));
            $query->whereHas('shapes', function ($query) use ($formattedShape) {
                $query->where('name', '=', $formattedShape);
            });
        }

        // Filtro para 'material' - apenas se o valor for fornecido
        if ($material) {
            // Formata o valor do material substituindo hífens por espaços e capitalizando
            $formattedMaterial = ucwords(str_replace('-', ' ', strtolower($material)));

            // Aplica o filtro de material com o valor formatado
            $query->whereHas('materials', function ($query) use ($formattedMaterial) {
                $query->where('name', '=', $formattedMaterial);
            });
        }



        $product = $query->get();
        return response()->json([
            'theHTML' => view('products-only', ['products' => $product])->render()
        ]);
    }

    public function filterPriceAscending(Request $request)
    {
        $isDesign = $request->input('isDesign');
        $event = filter_var($request->input('event'));
        $productType = filter_var($request->input('type'));
        $size = filter_var($request->input('size'));
        $shape = filter_var($request->input('shape'));
        $material = filter_var($request->input('material'));

        $query = Product::orderBy('price', "ASC");

        if ($isDesign == 'true') {
            $query->where('name', 'LIKE', '%Try Before Buy%');
        } else {
            $query->where('name', 'NOT LIKE', '%Try Before Buy%');
        }

        // Filtro para 'event' - apenas se o valor for fornecido
        // Filtro para 'event' - apenas se o valor for fornecido
        if ($event) {
            $formattedEvent = ucwords(str_replace('-', ' ', strtolower($event)));
            $query->whereHas('events', function ($query) use ($formattedEvent) {
                $query->where('name', '=', $formattedEvent);
            });
        }

        // Filtro para 'product_type' - apenas se o valor for fornecido
        if ($productType != null) {
            // Substitui hífens por espaços e capitaliza a primeira letra de cada palavra
            $formattedProductType = ucwords(str_replace('-', ' ', strtolower($productType)));
            $query->where('flower_type', '=', $formattedProductType);
        }

        // Filtro para 'size' - apenas se o valor for fornecido
        if ($size) {
            $formattedSize = ucwords(str_replace('-', ' ', strtolower($size)));
            $query->whereHas('sizes', function ($query) use ($formattedSize) {
                $query->where('name', '=', $formattedSize);
            });
        }

        // Filtro para 'shape' - apenas se o valor for fornecido
        if ($shape) {
            $formattedShape = ucwords(str_replace('-', ' ', strtolower($shape)));
            $query->whereHas('shapes', function ($query) use ($formattedShape) {
                $query->where('name', '=', $formattedShape);
            });
        }

        // Filtro para 'material' - apenas se o valor for fornecido
        if ($material) {
            // Formata o valor do material substituindo hífens por espaços e capitalizando
            $formattedMaterial = ucwords(str_replace('-', ' ', strtolower($material)));

            // Aplica o filtro de material com o valor formatado
            $query->whereHas('materials', function ($query) use ($formattedMaterial) {
                $query->where('name', '=', $formattedMaterial);
            });
        }



        $product = $query->get();
        return response()->json([
            'theHTML' => view('products-only', ['products' => $product])->render()
        ]);
    }

    public function filterPriceDescending(Request $request)
    {
        $isDesign = $request->input('isDesign');
        $event = filter_var($request->input('event'));
        $productType = filter_var($request->input('type'));
        $size = filter_var($request->input('size'));
        $shape = filter_var($request->input('shape'));
        $material = filter_var($request->input('material'));

        $query = Product::orderBy('price', "DESC");

        if ($isDesign == 'true') {
            $query->where('name', 'LIKE', '%Try Before Buy%');
        } else {
            $query->where('name', 'NOT LIKE', '%Try Before Buy%');
        }

        // Filtro para 'event' - apenas se o valor for fornecido
        // Filtro para 'event' - apenas se o valor for fornecido
        if ($event) {
            $formattedEvent = ucwords(str_replace('-', ' ', strtolower($event)));
            $query->whereHas('events', function ($query) use ($formattedEvent) {
                $query->where('name', '=', $formattedEvent);
            });
        }

        // Filtro para 'product_type' - apenas se o valor for fornecido
        if ($productType != null) {
            // Substitui hífens por espaços e capitaliza a primeira letra de cada palavra
            $formattedProductType = ucwords(str_replace('-', ' ', strtolower($productType)));
            $query->where('flower_type', '=', $formattedProductType);
        }

        // Filtro para 'size' - apenas se o valor for fornecido
        if ($size) {
            $formattedSize = ucwords(str_replace('-', ' ', strtolower($size)));
            $query->whereHas('sizes', function ($query) use ($formattedSize) {
                $query->where('name', '=', $formattedSize);
            });
        }

        // Filtro para 'shape' - apenas se o valor for fornecido
        if ($shape) {
            $formattedShape = ucwords(str_replace('-', ' ', strtolower($shape)));
            $query->whereHas('shapes', function ($query) use ($formattedShape) {
                $query->where('name', '=', $formattedShape);
            });
        }

        // Filtro para 'material' - apenas se o valor for fornecido
        if ($material) {
            // Formata o valor do material substituindo hífens por espaços e capitalizando
            $formattedMaterial = ucwords(str_replace('-', ' ', strtolower($material)));

            // Aplica o filtro de material com o valor formatado
            $query->whereHas('materials', function ($query) use ($formattedMaterial) {
                $query->where('name', '=', $formattedMaterial);
            });
        }



        $product = $query->get();
        return response()->json([
            'theHTML' => view('products-only', ['products' => $product])->render()
        ]);
    }

    public function filterDateAscending(Request $request)
    {
        $isDesign = $request->input('isDesign');
        $event = filter_var($request->input('event'));
        $productType = filter_var($request->input('type'));
        $size = filter_var($request->input('size'));
        $shape = filter_var($request->input('shape'));
        $material = filter_var($request->input('material'));

        $query = Product::orderBy('updated_at');

        if ($isDesign == 'true') {
            $query->where('name', 'LIKE', '%Try Before Buy%');
        } else {
            $query->where('name', 'NOT LIKE', '%Try Before Buy%');
        }

        // Filtro para 'event' - apenas se o valor for fornecido
        // Filtro para 'event' - apenas se o valor for fornecido
        if ($event) {
            $formattedEvent = ucwords(str_replace('-', ' ', strtolower($event)));
            $query->whereHas('events', function ($query) use ($formattedEvent) {
                $query->where('name', '=', $formattedEvent);
            });
        }

        // Filtro para 'product_type' - apenas se o valor for fornecido
        if ($productType != null) {
            // Substitui hífens por espaços e capitaliza a primeira letra de cada palavra
            $formattedProductType = ucwords(str_replace('-', ' ', strtolower($productType)));
            $query->where('flower_type', '=', $formattedProductType);
        }

        // Filtro para 'size' - apenas se o valor for fornecido
        if ($size) {
            $formattedSize = ucwords(str_replace('-', ' ', strtolower($size)));
            $query->whereHas('sizes', function ($query) use ($formattedSize) {
                $query->where('name', '=', $formattedSize);
            });
        }

        // Filtro para 'shape' - apenas se o valor for fornecido
        if ($shape) {
            $formattedShape = ucwords(str_replace('-', ' ', strtolower($shape)));
            $query->whereHas('shapes', function ($query) use ($formattedShape) {
                $query->where('name', '=', $formattedShape);
            });
        }

        // Filtro para 'material' - apenas se o valor for fornecido
        if ($material) {
            // Formata o valor do material substituindo hífens por espaços e capitalizando
            $formattedMaterial = ucwords(str_replace('-', ' ', strtolower($material)));

            // Aplica o filtro de material com o valor formatado
            $query->whereHas('materials', function ($query) use ($formattedMaterial) {
                $query->where('name', '=', $formattedMaterial);
            });
        }



        $product = $query->get();
        return response()->json([
            'theHTML' => view('products-only', ['products' => $product])->render()
        ]);
    }

    public function filterDateDescending(Request $request)
    {
        $isDesign = $request->input('isDesign');
        $event = filter_var($request->input('event'));
        $productType = filter_var($request->input('type'));
        $size = filter_var($request->input('size'));
        $shape = filter_var($request->input('shape'));
        $material = filter_var($request->input('material'));

        $query = Product::orderBy('updated_at', "DESC");

        if ($isDesign == 'true') {
            $query->where('name', 'LIKE', '%Try Before Buy%');
        } else {
            $query->where('name', 'NOT LIKE', '%Try Before Buy%');
        }

        // Filtro para 'event' - apenas se o valor for fornecido
        // Filtro para 'event' - apenas se o valor for fornecido
        if ($event) {
            $formattedEvent = ucwords(str_replace('-', ' ', strtolower($event)));
            $query->whereHas('events', function ($query) use ($formattedEvent) {
                $query->where('name', '=', $formattedEvent);
            });
        }

        // Filtro para 'product_type' - apenas se o valor for fornecido
        if ($productType != null) {
            // Substitui hífens por espaços e capitaliza a primeira letra de cada palavra
            $formattedProductType = ucwords(str_replace('-', ' ', strtolower($productType)));
            $query->where('flower_type', '=', $formattedProductType);
        }

        // Filtro para 'size' - apenas se o valor for fornecido
        if ($size) {
            $formattedSize = ucwords(str_replace('-', ' ', strtolower($size)));
            $query->whereHas('sizes', function ($query) use ($formattedSize) {
                $query->where('name', '=', $formattedSize);
            });
        }

        // Filtro para 'shape' - apenas se o valor for fornecido
        if ($shape) {
            $formattedShape = ucwords(str_replace('-', ' ', strtolower($shape)));
            $query->whereHas('shapes', function ($query) use ($formattedShape) {
                $query->where('name', '=', $formattedShape);
            });
        }

        // Filtro para 'material' - apenas se o valor for fornecido
        if ($material) {
            // Formata o valor do material substituindo hífens por espaços e capitalizando
            $formattedMaterial = ucwords(str_replace('-', ' ', strtolower($material)));

            // Aplica o filtro de material com o valor formatado
            $query->whereHas('materials', function ($query) use ($formattedMaterial) {
                $query->where('name', '=', $formattedMaterial);
            });
        }



        $product = $query->get();
        return response()->json([
            'theHTML' => view('products-only', ['products' => $product])->render()
        ]);
    }

    public function filterInStock(Request $request)
    {
        $isDesign = $request->input('isDesign');
        $event = filter_var($request->input('event'));
        $productType = filter_var($request->input('type'));
        $size = filter_var($request->input('size'));
        $shape = filter_var($request->input('shape'));
        $material = filter_var($request->input('material'));

        $query = Product::where('quantity', '>', 0);

        // Filtro para 'event' - apenas se o valor for fornecido
        // Filtro para 'event' - apenas se o valor for fornecido
        if ($event) {
            $formattedEvent = ucwords(str_replace('-', ' ', strtolower($event)));
            $query->whereHas('events', function ($query) use ($formattedEvent) {
                $query->where('name', '=', $formattedEvent);
            });
        }

        // Filtro para 'product_type' - apenas se o valor for fornecido
        if ($productType != null) {
            // Substitui hífens por espaços e capitaliza a primeira letra de cada palavra
            $formattedProductType = ucwords(str_replace('-', ' ', strtolower($productType)));
            $query->where('flower_type', '=', $formattedProductType);
        }

        // Filtro para 'size' - apenas se o valor for fornecido
        if ($size) {
            $formattedSize = ucwords(str_replace('-', ' ', strtolower($size)));
            $query->whereHas('sizes', function ($query) use ($formattedSize) {
                $query->where('name', '=', $formattedSize);
            });
        }

        // Filtro para 'shape' - apenas se o valor for fornecido
        if ($shape) {
            $formattedShape = ucwords(str_replace('-', ' ', strtolower($shape)));
            $query->whereHas('shapes', function ($query) use ($formattedShape) {
                $query->where('name', '=', $formattedShape);
            });
        }

        // Filtro para 'material' - apenas se o valor for fornecido
        if ($material) {
            // Formata o valor do material substituindo hífens por espaços e capitalizando
            $formattedMaterial = ucwords(str_replace('-', ' ', strtolower($material)));

            // Aplica o filtro de material com o valor formatado
            $query->whereHas('materials', function ($query) use ($formattedMaterial) {
                $query->where('name', '=', $formattedMaterial);
            });
        }




        if ($isDesign == 'true') {
            $query->where('name', 'LIKE', '%Try Before Buy%');
        } else {
            $query->where('name', 'NOT LIKE', '%Try Before Buy%');
        }

        $product = $query->get();
        return response()->json([
            'theHTML' => view('products-only', ['products' => $product])->render()
        ]);
    }

    public function filterOutStock(Request $request)
    {
        $isDesign = $request->input('isDesign');
        $event = filter_var($request->input('event'));
        $productType = filter_var($request->input('type'));
        $size = filter_var($request->input('size'));
        $shape = filter_var($request->input('shape'));
        $material = filter_var($request->input('material'));

        $query = Product::where('quantity', '=', 0);

        // Filtro para 'event' - apenas se o valor for fornecido
        // Filtro para 'event' - apenas se o valor for fornecido
        if ($event) {
            $formattedEvent = ucwords(str_replace('-', ' ', strtolower($event)));
            $query->whereHas('events', function ($query) use ($formattedEvent) {
                $query->where('name', '=', $formattedEvent);
            });
        }

        // Filtro para 'product_type' - apenas se o valor for fornecido
        if ($productType != null) {
            // Substitui hífens por espaços e capitaliza a primeira letra de cada palavra
            $formattedProductType = ucwords(str_replace('-', ' ', strtolower($productType)));
            $query->where('flower_type', '=', $formattedProductType);
        }

        // Filtro para 'size' - apenas se o valor for fornecido
        if ($size) {
            $formattedSize = ucwords(str_replace('-', ' ', strtolower($size)));
            $query->whereHas('sizes', function ($query) use ($formattedSize) {
                $query->where('name', '=', $formattedSize);
            });
        }

        // Filtro para 'shape' - apenas se o valor for fornecido
        if ($shape) {
            $formattedShape = ucwords(str_replace('-', ' ', strtolower($shape)));
            $query->whereHas('shapes', function ($query) use ($formattedShape) {
                $query->where('name', '=', $formattedShape);
            });
        }

        // Filtro para 'material' - apenas se o valor for fornecido
        if ($material) {
            // Formata o valor do material substituindo hífens por espaços e capitalizando
            $formattedMaterial = ucwords(str_replace('-', ' ', strtolower($material)));

            // Aplica o filtro de material com o valor formatado
            $query->whereHas('materials', function ($query) use ($formattedMaterial) {
                $query->where('name', '=', $formattedMaterial);
            });
        }


        // Filtro para 'isDesign' - apenas se o valor for fornecido
        if ($isDesign == 'true') {
            $query->where('name', 'LIKE', '%Try Before Buy%');
        } else {
            $query->where('name', 'NOT LIKE', '%Try Before Buy%');
        }

        $product = $query->get();
        return response()->json([
            'theHTML' => view('products-only', ['products' => $product])->render()
        ]);
    }



    public function filterColor(Request $request, $colors)
    {
        $isDesign = $request->input('isDesign');
        $event = filter_var($request->input('event'));
        $productType = filter_var($request->input('type'));
        $size = filter_var($request->input('size'));
        $shape = filter_var($request->input('shape'));
        $material = filter_var($request->input('material'));

        // Transformar a string de cores em um array
        $colorsArray = explode(',', $colors);

        // Iniciar a consulta
        $query = Product::query();

        // Se houver cores selecionadas, adicione a condição de cor
        if (!empty($colorsArray)) {
            foreach ($colorsArray as $colorName) {
                $colorId = Color::where('name', strtolower($colorName))->value('id');

                if ($colorId) {
                    $query->orWhere(function ($query) use ($colorId, $isDesign) {
                        if ($isDesign == 'true') {
                            $query->where('name', 'LIKE', '%Try Before Buy%');
                        } else {
                            $query->where('name', 'NOT LIKE', '%Try Before Buy%');
                        }
                        $query->where('eachcolor_image', 'LIKE', '%"' . $colorId . '"%');
                    });
                }
            }
        } else {
            if ($isDesign == 'true') {
                $query->where('name', 'LIKE', '%Try Before Buy%');
            } else {
                $query->where('name', 'NOT LIKE', '%Try Before Buy%');
            }
        }

        // Filtro para 'event' - apenas se o valor for fornecido
        // Filtro para 'event' - apenas se o valor for fornecido
        if ($event) {
            $formattedEvent = ucwords(str_replace('-', ' ', strtolower($event)));
            $query->whereHas('events', function ($query) use ($formattedEvent) {
                $query->where('name', '=', $formattedEvent);
            });
        }

        // Filtro para 'product_type' - apenas se o valor for fornecido
        if ($productType != null) {
            // Substitui hífens por espaços e capitaliza a primeira letra de cada palavra
            $formattedProductType = ucwords(str_replace('-', ' ', strtolower($productType)));
            $query->where('flower_type', '=', $formattedProductType);
        }

        // Filtro para 'size' - apenas se o valor for fornecido
        if ($size) {
            $formattedSize = ucwords(str_replace('-', ' ', strtolower($size)));
            $query->whereHas('sizes', function ($query) use ($formattedSize) {
                $query->where('name', '=', $formattedSize);
            });
        }

        // Filtro para 'shape' - apenas se o valor for fornecido
        if ($shape) {
            $formattedShape = ucwords(str_replace('-', ' ', strtolower($shape)));
            $query->whereHas('shapes', function ($query) use ($formattedShape) {
                $query->where('name', '=', $formattedShape);
            });
        }

        // Filtro para 'material' - apenas se o valor for fornecido
        if ($material) {
            // Formata o valor do material substituindo hífens por espaços e capitalizando
            $formattedMaterial = ucwords(str_replace('-', ' ', strtolower($material)));

            // Aplica o filtro de material com o valor formatado
            $query->whereHas('materials', function ($query) use ($formattedMaterial) {
                $query->where('name', '=', $formattedMaterial);
            });
        }



        $products = $query->get();

        return response()->json([
            'theHTML' => view('products-only', ['products' => $products])->render()
        ]);
    }

    public function filterByPrice(Request $request, $min, $max)
    {
        $isDesign = $request->input('isDesign');
        $event = filter_var($request->input('event'));
        $productType = filter_var($request->input('type'));
        $size = filter_var($request->input('size'));
        $shape = filter_var($request->input('shape'));
        $material = filter_var($request->input('material'));

        $query = Product::where('price', '>=', $min)
            ->where('price', '<=', $max);


        if ($isDesign == 'true') {
            $query->where('name', 'LIKE', '%Try Before Buy%');
        } else {
            $query->where('name', 'NOT LIKE', '%Try Before Buy%');
        }

        // Filtro para 'event' - apenas se o valor for fornecido
        if ($event) {
            $formattedEvent = ucwords(str_replace('-', ' ', strtolower($event)));
            $query->whereHas('events', function ($query) use ($formattedEvent) {
                $query->where('name', '=', $formattedEvent);
            });
        }

        // Filtro para 'product_type' - apenas se o valor for fornecido
        if ($productType != null) {
            // Substitui hífens por espaços e capitaliza a primeira letra de cada palavra
            $formattedProductType = ucwords(str_replace('-', ' ', strtolower($productType)));
            $query->where('flower_type', '=', $formattedProductType);
        }

        // Filtro para 'size' - apenas se o valor for fornecido
        if ($size) {
            $formattedSize = ucwords(str_replace('-', ' ', strtolower($size)));
            $query->whereHas('sizes', function ($query) use ($formattedSize) {
                $query->where('name', '=', $formattedSize);
            });
        }

        // Filtro para 'shape' - apenas se o valor for fornecido
        if ($shape) {
            $formattedShape = ucwords(str_replace('-', ' ', strtolower($shape)));
            $query->whereHas('shapes', function ($query) use ($formattedShape) {
                $query->where('name', '=', $formattedShape);
            });
        }

        // Filtro para 'material' - apenas se o valor for fornecido
        if ($material) {
            // Formata o valor do material substituindo hífens por espaços e capitalizando
            $formattedMaterial = ucwords(str_replace('-', ' ', strtolower($material)));

            // Aplica o filtro de material com o valor formatado
            $query->whereHas('materials', function ($query) use ($formattedMaterial) {
                $query->where('name', '=', $formattedMaterial);
            });
        }



        $product = $query->get();

        return response()->json([
            'theHTML' => view('products-only', ['products' => $product])->render()
        ]);
    }
}
