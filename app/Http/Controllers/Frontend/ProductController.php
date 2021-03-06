<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\ProductFilterProductSubcategory;
use App\Product;
use App\ProductSubcategory;
use App\ProductSubCategoryProduct;
use App\ProductCategory;
use App\ProductBrand;
use App\ProductFilter;
use App\ProductFilterProduct;
use App\Banner;
use App\BannerType;
use App\ProductPicture;

use App\Models\CaracteristicCategory;
use App\Models\caracteristic_product;
use App\Models\Caracteristic;

use Share;
use Session;

class ProductController extends Controller{
    public function category(Request $request){
       $categoria  = $request->cat;
        $tipo       = 'category';
        $brands     =[];
        $category   = ProductCategory::where('slug', $categoria)->first();
        $filtros    = $request->filters; //la asignamoda una varible por lo que la peticion traun un array
        $products;
        $filters    =[];
        //dd($request->all());
        if ($category) {
          $brands = ProductBrand::whereHas('products', function($q1) use ($categoria){
                $q1->whereHas('product_categories', function($q2) use ($categoria){
                    $q2->whereHas('categories', function($q3) use ($categoria){
                        $q3->where('slug', $categoria);
                    })->where('estado', 1);
                })->where('published', 1);
          })->where('estado', 1)->pluck('nombre', 'id');


            //Trae todos los productos si no hay nada asignados
            $products = ProductSubcategory::where('product_categories_id',$category->id)
                                          ->join('product_subcategory_product','product_subcategory_product.product_subcategory_id','product_subcategories.id')
                                          ->join('products','products.id','product_subcategory_product.product_id')
                                          //->join('product_pictures','product_pictures.products_id','products.id')
                                          //->where('product_pictures.posicion',1)
                                          ->where('products.published',1)
                                          ->orderBy('products.id','DESC')
                                          ->get();
            //trae las subcatergorias que tienen los productos asociadas
            $subcategories = ProductSubcategory::where('product_categories_id',$category->id)
                                                ->where('estado',1)->pluck('nombre','slug');
            //Trae los filtros que tienen asociados los productos

            // foreach ($subcategories as $key =>$subcategoriess) {
            // $filterss = ProductSubcategory::where('product_subcategories.product_categories_id',$category->id)
            //                               ->where('product_subcategories.slug',$key)
            //                               ->join('product_filter_product_subcategory','product_filter_product_subcategory.product_subcategory_id','product_subcategories.id')
            //                               ->join('product_filters','product_filters.id','product_filter_product_subcategory.product_filter_id')
            //                               ->orderBy('nombre','ASC')->pluck('product_filters.nombre','product_filters.id');
            //   foreach ($filterss as $id=> $value) {
            //     $filters[$id] =$value;
            //   }
            // }


            $marcas = ProductBrand::where('slug',$request->brands)->first();
            $sucat = ProductSubcategory::where('product_subcategories.slug',$request->subcategories)->first();
            // if ($request->filters && $request->brands  && $request->subcategories) {
            //   foreach ($filtros as $filtr) {
            //     $products = ProductFilterProduct::where('product_filter_id',$filtr)
            //                                     ->join('products','products.id','product_filter_product.product_id')
            //                                     ->join('product_subcategory_product','product_subcategory_product.product_id','products.id')
            //                                     ->join('product_subcategories','product_subcategories.id','product_subcategory_product.product_subcategory_id')
            //                                     ->where('product_subcategories.product_categories_id',$category->id)
            //                                     ->where('product_subcategories.slug',$request->subcategories)
            //                                     ->where('products.brands_id',$request->brands)
            //                                     ->get();
            //   }
            // }
            // elseif ($request->filters && $request->brands) {
            //   foreach ($filtros as $filtr) {
            //     $products = product::where('brands_id',$request->brands)
            //                           ->join('product_filter_product','product_filter_product.product_id','products.id')
            //                           ->join('product_filters','product_filters.id','product_filter_product.product_filter_id')
            //                           ->join('product_filter_product_subcategory','product_filter_product_subcategory.product_filter_id','product_filters.id')
            //                           ->join('product_subcategories','product_subcategories.id','product_filter_product_subcategory.product_subcategory_id')
            //                           ->where('product_subcategories.product_categories_id',$category->id)
            //                           ->where('product_filters.id',$filtr)->get();
            //   }
            // }
            // elseif ($request->filters && $request->subcategories) {
            //   foreach ($filtros as $filtr) {
            //     $products = ProductFilterProduct::where('product_filter_id',$filtr)
            //                                     ->join('products','products.id','product_filter_product.product_id')
            //                                     ->join('product_subcategory_product','product_subcategory_product.product_id','products.id')
            //                                     ->join('product_subcategories','product_subcategories.id','product_subcategory_product.product_subcategory_id')
            //                                     ->where('product_subcategories.product_categories_id',$category->id)
            //                                     ->where('product_subcategories.slug',$request->subcategories)
            //                                     ->get();
            //   }
            // }
            if ($request->subcategories && $request->brands ) 
            {
              $products = ProductSubcategory::where('product_subcategories.product_categories_id',$category->id)
                                            ->where('product_subcategories.slug',$request->subcategories)
                                            ->join('product_subcategory_product','product_subcategory_product.product_subcategory_id','product_subcategories.id')
                                            ->join('products','products.id','product_subcategory_product.product_id')
                                            ->where('products.brands_id',$request->brands)->get();
            }
            // elseif ($filtros) {
            //     foreach ($filtros as $filtr) {
            //       $products = ProductSubcategory::where('product_categories_id',$category->id)
            //                                     ->join('product_filter_product_subcategory','product_filter_product_subcategory.product_subcategory_id','product_subcategories.id')
            //                                     ->join('product_filters','product_filters.id','product_filter_product_subcategory.product_filter_id')
            //                                     ->where('product_filters.id',$filtr)
            //                                     ->join('product_filter_product','product_filter_product.product_filter_id','product_filters.id')
            //                                     ->join('products','products.id','product_filter_product.product_id')->get();
            //     }
            // }
            elseif ($request->subcategories) 
            {
              return redirect('products/subcategory?cat='.$request->subcategories);

            }
            elseif ($request->brands) 
            {
              $products = ProductSubcategory::where('product_subcategories.product_categories_id',$category->id)
                                            ->join('product_subcategory_product','product_subcategory_product.product_subcategory_id','product_subcategories.id')
                                            ->join('products','products.id','product_subcategory_product.product_id')
                                            ->where('products.brands_id',$request->brands)
                                            ->get();
            }
            foreach ($products as $images) 
            {
                if(!isset($images->id)) $images = $images[0];
                $imagenes =  ProductPicture::where('products_id',$images->id)->first(); //hace la consulta de las imagenes que tiene asociada el producto y trae la primera
                if(isset($imagenes->link_imagen)) //mira si esa propiedad tiene algo y se hace sin corchetes por que solo es una sola linea
                  array_add($images,'link',$imagenes->link_imagen);//agrega un campo al array de productos para mostrar las imagenes
                else
                  array_add($images,'link','images/no-image.jpg');//si no tiene imagenes asociadas manda la ruta de NO IMAGE
              }
            $datos = count($products);
            for ($i=1; $i <$datos ; $i++) 
            {
              if ($i < $datos-1) 
              {
                if(isset($products[$i]->id)&&isset($products[$i+1]->id))
                {
                  if ($products[$i]->id == $products[$i+1]->id) 
                  {
                    unset($products[$i]);
                  }
                }
              }
            }

            $realCategoria = ProductCategory::where('slug', $categoria)->first();
            $TipoBanner = BannerType::where('slug',$realCategoria->slug)->first();
            if (isset($sel_filter)) {
                return view('user.products.categoria', compact('products','brands', 'tipo', 'category', 'sel_filter', 'subcategories','TipoBanner'));
            } else {
                return view('user.products.categoria', compact('products','brands','tipo', 'category', 'subcategories','TipoBanner'));
            }
        } else {
            return redirect('/');
        }
    }
    public function subcategory(Request $request)
      {
          $categoria = $request->cat;
          $tipo      = 'subcategory';
          $category = ProductSubcategory::where('slug', $categoria)->first();
          // $filtros    = $request->filters; //la asignamoda una varible por lo que la peticion traun un array
          $products;
          // $filters    =[];
          // dd($request->all());
          $caracteristicCategories = [];
          $caracteristicOptions = [];
          if ($category) {
              $brands = ProductBrand::whereHas('products', function($q1) use ($categoria){
                  $q1->whereHas('product_categories', function($q2) use ($categoria){
                      $q2->where('slug', $categoria)->where('estado',1);
                  })->where('published', 1);
              })->where('estado', 1)->pluck('nombre', 'slug');
              //Trae todos los productos si no hay nada asignados
              $products = ProductSubCategoryProduct::where('product_subcategory_id',$category->id)
                                            //->join('product_subcategory_product','product_subcategory_product.product_subcategory_id','product_subcategories.id')
                                            ->join('products','products.id','product_subcategory_product.product_id')
                                            ->where('products.published',1)
                                            ->get();
              //trae las subcatergorias que tienen los productos asociadas
              $subcategories = ProductSubcategory::where('product_categories_id',$category->id)
                                                  ->where('estado',1)->pluck('nombre','slug');
              //Trae los filtros que tienen asociados los prioductos
              // $filterss = ProductFilterProductSubcategory::where('product_subcategory_id',$category->id)
              //                                             //->where('product_subcategories.slug',$key)
              //                                             //->join('product_filter_product_subcategory','product_filter_product_subcategory.product_subcategory_id','product_subcategories.id')
              //                                             ->join('product_filters','product_filters.id','product_filter_product_subcategory.product_filter_id')
              //                                             ->orderBy('nombre','ASC')
              //                                             ->pluck('product_filters.nombre','product_filters.id');
              // foreach ($filterss as $id=> $value) {
              //     $filters[$id] =$value;
              //   }
                                                  $prueba=[];
              foreach ($products as $product) 
              {
                $categoryCaracteristicProduct= caracteristic_product::where('fk_product',$product->id)->get();
                if(count($categoryCaracteristicProduct)>0)
                {
                  foreach($categoryCaracteristicProduct as $results)
                  {
                    $categoryCaract = CaracteristicCategory::find($results->fk_category);
                    $option = Caracteristic::find($results->fk_caracteristic);
                    if(!in_array($categoryCaract->id_caracteristic_category,$caracteristicCategories))
                    {
                      $caracteristicCategories[$categoryCaract->id_caracteristic_category] = array($categoryCaract->id_caracteristic_category,$categoryCaract->category_name);
                    }
                    $stateCaracteristic = false;
                    if(count($caracteristicOptions)>0)
                    {
                      foreach($caracteristicOptions as $caracteristic)
                      {
                        if($caracteristic['id_caracteristic'] ==$option->id_caracteristic)
                        {
                          $stateCaracteristic=true;
                        }
                      }
                    }
                    
                    if(!$stateCaracteristic)
                    {
                      $caracteristicOptions[]=array('category'=>$categoryCaract->id_caracteristic_category,
                        'id_caracteristic'=>$option->id_caracteristic,
                        'caracteristic'=>$option->name_caracteristic);
                    }
                  }
                }
              }
              $searchByCategory=false;
              $cantCaracteristic=0;
              if($request->caracteristic)
              {
                foreach ($request->caracteristic as  $idCategory =>$caracteristic) 
                {
                  if($caracteristic[0])
                    {
                      $searchByCategory=true;
                      $cantCaracteristic++;
                    }
                }
              }

              $marcas = ProductBrand::where('slug',$request->brands)->first();
              if ($searchByCategory && $request->brands) 
              {

                 if($cantCaracteristic==1)
                {
                  foreach ($request->caracteristic as $idCategory =>$caracteristic) 
                  {
                    if($caracteristic[0])
                    {
                      $products = product::where('brands_id',$marcas->id)
                                  ->join('caracteristic_products','caracteristic_products.fk_product','products.id')
                                  ->where('caracteristic_products.fk_category',$idCategory)
                                  ->where('caracteristic_products.fk_caracteristic',(int)$caracteristic[0])
                                  ->get();
                    }
                  }
                }
                else
                {
                  $i=0;
                  $newProducts=[];
                  foreach ($request->caracteristic as $idCategory =>$caracteristic) 
                  {
                    if($caracteristic[0])
                    {

                      if($i==0)
                      {
                        $products = product::where('brands_id',$marcas->id)
                                  ->join('caracteristic_products','caracteristic_products.fk_product','products.id')
                                  ->where('caracteristic_products.fk_category',$idCategory)
                                  ->where('caracteristic_products.fk_caracteristic',(int)$caracteristic[0])
                                  ->get();
                      }
                      else
                      {
                        foreach ($products as $product) 
                        {
                          $newProduct = product::where('brands_id',$marcas->id)
                                  ->join('caracteristic_products','caracteristic_products.fk_product','products.id')
                                  ->where('caracteristic_products.fk_category',$idCategory)
                                  ->where('caracteristic_products.fk_caracteristic',(int)$caracteristic[0])
                                  ->where('caracteristic_products.fk_product',$product->id)
                                  ->first();
                         if(count($newProduct)>0)
                          {
                            array_push($newProducts,$newProduct);

                          }
                        }
                        $products = $newProducts;
                      }
                      $i++;
                    }
                  }
                }

                // foreach ($request->caracteristic as $idCategory =>$caracteristic) 
                // {
                //   if($caracteristic[0])
                //   {
                    
                //   }
                // }
              }
              elseif ($searchByCategory) 
              {
                if($cantCaracteristic==1)
                {
                  foreach ($request->caracteristic as $idCategory =>$caracteristic) 
                  {
                    if($caracteristic[0])
                    {
                      $products = ProductSubcategory::where('product_subcategories.id',$category->id)
                                        ->join('product_subcategory_product','product_subcategory_product.product_subcategory_id','product_subcategories.id')
                                        ->join('products','products.id','product_subcategory_product.product_id')
                                        ->join('caracteristic_products','caracteristic_products.fk_product','products.id')
                                        ->where('caracteristic_products.fk_category',$idCategory)
                                        ->where('caracteristic_products.fk_caracteristic',(int)$caracteristic[0])
                                ->get();
                    }
                  }
                }
                else
                {
                  $i=0;
                  $newProducts=[];
                  foreach ($request->caracteristic as $idCategory =>$caracteristic) 
                  {
                    if($caracteristic[0])
                    {

                      if($i==0)
                      {
                        $products = ProductSubcategory::where('product_subcategories.id',$category->id)
                                        ->join('product_subcategory_product','product_subcategory_product.product_subcategory_id','product_subcategories.id')
                                        ->join('products','products.id','product_subcategory_product.product_id')
                                        ->join('caracteristic_products','caracteristic_products.fk_product','products.id')
                                        ->where('caracteristic_products.fk_category',$idCategory)
                                        ->where('caracteristic_products.fk_caracteristic',(int)$caracteristic[0])
                                ->get();
                      }
                      else
                      {
                        foreach ($products as $product) 
                        {
                          $newProduct = ProductSubcategory::where('product_subcategories.id',$category->id)
                                        ->join('product_subcategory_product','product_subcategory_product.product_subcategory_id','product_subcategories.id')
                                        ->join('products','products.id','product_subcategory_product.product_id')
                                        ->join('caracteristic_products','caracteristic_products.fk_product','products.id')
                                        ->where('caracteristic_products.fk_category',$idCategory)
                                        ->where('caracteristic_products.fk_caracteristic',(int)$caracteristic[0])
                                        ->where('caracteristic_products.fk_product',$product->id)
                                ->first();
 
                         if(count($newProduct)>0)
                          {
                            array_push($newProducts,$newProduct);

                          }
                        }
                        $products = $newProducts;
                      }
                      $i++;
                    }
                  }
                }
                
              }
              elseif ($request->brands) 
              {
                $products = ProductSubcategory::where('product_subcategories.id',$category->id)
                                              ->where('product_subcategories.slug',$request->cat)
                                              ->join('product_subcategory_product','product_subcategory_product.product_subcategory_id','product_subcategories.id')
                                              ->join('products','products.id','product_subcategory_product.product_id')
                                              ->where('products.brands_id',$marcas->id)
                                              ->get();
              }
              foreach ($products as $images) 
              {
                $imagenes =  ProductPicture::where('products_id',$images->id)->first(); //hace la consulta de las imagenes que tiene asociada el producto y trae la primera
                if(isset($imagenes->link_imagen)) //mira si esa propiedad tiene algo y se hace sin corchetes por que solo es una sola linea
                  array_add($images,'link',$imagenes->link_imagen);//agrega un campo al array de productos para mostrar las imagenes
                else
                  array_add($images,'link','images/no-image.jpg');//si no tiene imagenes asociadas manda la ruta de NO IMAGE
              }

              $datos = count($products);
              $allproducts = [];
              for ($i=1; $i <$datos ; $i++) 
              {
                if ($i < $datos-1) 
                {
                  if(!in_array($products[$i]->id, $allproducts))
                  {
                    array_push($allproducts,$products[$i]->id);
                  }
                  else
                  {
                      unset($products[$i]);
                  }
                }
              }
              $realCategoria = ProductCategory::find($category->product_categories_id);
              $TipoBanner = BannerType::where('slug',$realCategoria->slug)->first();
//categoryCaracteristics
              $subcategoria = ProductSubcategory::where('slug',$categoria)->first();

              if (isset($sel_filter)) {
                  return view('user.products.categoria', compact('products','brands', 'tipo', 'category', 'sel_filter','TipoBanner','subcategoria','caracteristicOptions','caracteristicCategories'));
              } else {
                  return view('user.products.categoria', compact('products','brands', 'tipo', 'category','TipoBanner','subcategoria','caracteristicOptions','caracteristicCategories'));
              }


          } else {
              return redirect('/');
          }
      }

    public function brand(Request $request){
        $brand = $request->brand;

        $banners = Banner::whereHas('banner_types', function($query) use($brand){
           $query->where('slug', $brand);
        })->orderBy('created_at', 'desc')->first();


        $brand = ProductBrand::where('slug', $request->brand)->first();

        if ($request->has('filters') && $request->has('cat')) {
            $products = Product::whereHas('product_categories', function($q1) use ($request){
                $q1->whereHas('categories', function($q2) use ($request){
                    $q2->where('slug', $request->cat);
                });
            })->whereHas('brands', function($q) use ($request){
                $q->where('slug', $request->brand);
            })->whereHas('filters', function($q) use ($request){
                $q->whereIn('slug', $request->filters);
            })->where('published', 1)->with(['discounts' => function ($query){
                $query->where('estado', 1)->where('fecha_inicio', '<=', date('Y-m-d 00:00:00'))->where('fecha_fin', '>=', date('Y-m-d 23:59:59'))->where('codigo', null)->where('tipo_cupon', 'normal')->select('id','discount')->orderBy('created_at');
            }, 'images'])->orderBy('product_special', 'desc')->get();

            $sel_filter = $request->filters;
        } elseif ($request->has('cat')) {
            $products = Product::whereHas('product_categories', function($q1) use ($request){
                $q1->whereHas('categories', function($q2) use ($request){
                    $q2->where('slug', $request->cat);
                });
            })->whereHas('brands', function($q) use ($request){
                $q->where('slug', $request->brand);
            })->where('published', 1)->with(['discounts' => function ($query){
                $query->where('estado', 1)->where('fecha_inicio', '<=', date('Y-m-d 00:00:00'))->where('fecha_fin', '>=', date('Y-m-d 23:59:59'))->where('codigo', null)->where('tipo_cupon', 'normal')->select('id','discount')->orderBy('created_at');
            }, 'images'])->orderBy('product_special', 'desc')->get();
        } elseif ($request->has('filters')) {
            $products = Product::whereHas('brands', function($q) use ($request){
                $q->where('slug', $request->brand);
            })->whereHas('filters', function($q) use ($request){
                $q->whereIn('slug', $request->filters);
            })->where('published', 1)->with(['discounts' => function ($query){
                $query->where('estado', 1)->where('fecha_inicio', '<=', date('Y-m-d 00:00:00'))->where('fecha_fin', '>=', date('Y-m-d 23:59:59'))->where('codigo', null)->where('tipo_cupon', 'normal')->select('id','discount')->orderBy('created_at');
            }, 'images'])->orderBy('product_special', 'desc')->get();

            $sel_filter = $request->filters;
        } else {
            $products = Product::whereHas('brands', function($q) use ($request){
                $q->where('slug', $request->brand);
            })->where('published', 1)->with(['discounts' => function ($query){
                $query->where('estado', 1)->where('fecha_inicio', '<=', date('Y-m-d 00:00:00'))->where('fecha_fin', '>=', date('Y-m-d 23:59:59'))->where('codigo', null)->where('tipo_cupon', 'normal')->select('id','discount')->orderBy('created_at');
            }, 'images'])->orderBy('product_special', 'desc')->get();
        }

        $filters = ProductFilter::whereHas('products', function($q1) use ($request){
            $q1->whereHas('brands', function($q2) use ($request){
                $q2->where('slug', $request->brand)->where('estado', 1);
            })->where('published', 1);
        })->where('estado', 1)->pluck('nombre', 'slug');

        $brands = ProductBrand::where('slug', $request->brand)->where('estado', 1)->get();

        foreach ($products as $product) {
            $product = $this->formato_productos($product);
        }
     
       


        $TipoBanner = BannerType::where('slug',$brand->slug)->first();
        

        if (isset($sel_filter)) {
            return view('user.products.marca', compact('products','brands', 'filters', 'brand', 'sel_filter', 'banners', 'product_special','TipoBanner'));
        } else {
            return view('user.products.marca', compact('products','brands', 'filters', 'brand', 'banners', 'product_special','TipoBanner'));
        }
    }

    public function category_brand($tipo, $categoria, $marca){
        $brand = ProductBrand::where('slug', $marca)->first();

        if ($tipo === 'brand_cat') {
            $category = ProductCategory::where('slug', $categoria)->first();
            $products = Product::whereHas('product_categories', function($q1) use ($categoria){
                $q1->whereHas('categories', function($q2) use ($categoria){
                    $q2->where('slug', $categoria);
                });
            })->whereHas('brands', function ($q) use ($marca){
                $q->where('slug', $marca);
            })->where('published', 1)->get();

            $filters = ProductFilter::whereHas('product_categories', function($q1) use ($categoria){
                $q1->whereHas('categories', function($q2) use ($categoria){
                    $q2->where('slug', $categoria);
                });
            })->where('estado', 1)->get();

            $brands = ProductBrand::whereHas('products', function($q1) use ($categoria){
                $q1->whereHas('product_categories', function($q2) use ($categoria){
                    $q2->whereHas('categories', function($q3) use ($categoria){
                        $q3->where('slug', $categoria);
                    })->where('estado', 1);
                })->where('published', 1);
            })->where('estado', 1)->get();

        } elseif ($tipo === 'brand_sub') {
            $category = ProductSubcategory::where('slug', $categoria)->first();
            $products = Product::whereHas('product_categories', function($q1) use ($categoria){
                $q1->where('slug', $categoria);
            })->whereHas('brands', function ($q) use ($marca){
                $q->where('slug', $marca);
            })->where('published', 1)->get();

            $filters = ProductFilter::whereHas('product_categories', function($q1) use ($categoria){
                $q1->where('slug', $categoria);
            })->where('estado', 1)->get();

            $brands = ProductBrand::whereHas('products', function($q1) use ($categoria){
                $q1->whereHas('product_categories', function($q2) use ($categoria){
                    $q2->where('slug', $categoria)->where('estado',1);
                })->where('published', 1);
            })->where('estado', 1)->get();
        }

        foreach ($products as $product) {
            $product = $this->formato_productos($product);
        }

        return view('user.products.marca', compact('products','brands', 'filters', 'tipo', 'category', 'brand'));
    }

    public function product($slug)
    {
        $tags       = [];
        $filters    = [];
        $categories = [];
        $related    = [];

        $product = Product::where('slug', $slug)->where('published', 1)->with(['discounts' => function ($query){
            $query->where('estado', 1)->where('fecha_inicio', '<=', date('Y-m-d 00:00:00'))->where('fecha_fin', '>=', date('Y-m-d 23:59:59'))->where('codigo', null)->where('tipo_cupon', 'normal')->select('id','discount')->orderBy('created_at');
        }, 'images', 'additional'])->first();

        if (!$product)
        {
            return redirect('/');
        }
        else
        {
            $product = $this->formato_productos($product);
        }

        $subcategoria = $product->product_categories->first();
        $categoria = ProductCategory::find($subcategoria->product_categories_id);


        $images = ProductPicture::where('products_id',$product->id)->orderBy('posicion','asc')->get();

        $tags       = array_merge($tags, $product->tags->pluck('id')->toArray());
            $filters    = array_merge($tags, $product->filters->pluck('id')->toArray());
            $categories = array_merge($tags, $product->product_categories->pluck('id')->toArray());

        $related = Product::where('published', 1)
                ->where(function($q) use ($tags, $filters, $categories) {
                    $q->whereHas('tags' , function ($q2) use ($tags) {
                        $q2->whereIn('id', $tags);
                    })->orWhereHas('filters' , function ($q2) use ($filters) {
                        $q2->whereIn('id', $filters);
                    })->orWhereHas('product_categories' , function ($q3) use ($categories) {
                        $q3->whereIn('id', $categories);
                    });
                })
                ->take(5)
                ->inRandomOrder()
                ->get();

   $theProduct = $product;
 $padres = $product->product_dependency;
        if(count($padres)>0)
        {
            foreach ($padres as $product) 
            {
                $product->links = \Share::load(url('product/'.$product->slug), $product->title.' en Tauret Computadores')->services();

                if(count($product->discounts) > 0) {
                    $product->discount_price = ceil($product->price - ($product->price * ($product->discounts->first()->discount / 100)));
                }
                $product->image = $product->images->first()['link_imagen'];
            }
        }
        $product = $theProduct;
        $productImages = ProductPicture::where('products_id',$product->id)->orderBy('posicion','asc')->get();
        return view('user.products.product', compact('product','images','related','categoria','productImages','padres'));
    }

    public function sel_tipo(){
        return view('user.products.armar-pc');
    }

    public function arma_pc($tecnologia){
        $processors = Product::whereHas('product_categories', function($query){
            $query->whereIn('nombre', ['PROCESADORES']);
        })->where('published', 1)
        ->where('quantity', '>', 0)
        ->where('processor_type', $tecnologia)
        ->select('title', 'slug')
        ->pluck('title', 'slug')
        ->prepend('Selecciona el Procesador', '');

        $tvideo = Product::whereHas('product_categories', function($query){
            $query->whereIn('nombre', ['TARJETAS DE VÍDEO', 'TARJETAS DE VÍDEO NVIDIA', 'TARJETAS DE VIDEO AMD']);
        })->where('published', 1)
        ->where('quantity', '>', 0)
        ->whereIn('processor_type', ['n/a', $tecnologia])
        ->select('title', 'slug')->pluck('title', 'slug')
        ->prepend('Selecciona la Tarjeta Gráfica', '');

        $tred = Product::whereHas('product_categories', function($query){
            $query->whereIn('nombre', ['TARJETAS DE RED']);
        })->where('published', 1)
        ->where('quantity', '>', 0)
        ->whereIn('processor_type', ['n/a', $tecnologia])
        ->select('title', 'slug')->pluck('title', 'slug')
        ->prepend('Selecciona la Tarjeta de Red', '');

        $ssd = Product::whereHas('product_categories', function($query){
            $query->whereIn('nombre', ['UNIDADES SOLIDAS']);
        })->where('published', 1)
        ->where('quantity', '>', 0)
        ->whereIn('processor_type', ['n/a', $tecnologia])
        ->select('title', 'slug')->pluck('title', 'slug')
        ->prepend('Selecciona la Unidad SSD', '');

        $hdd = Product::whereHas('product_categories', function($query){
            $query->whereIn('nombre', ['DISCOS DUROS']);
        })->where('published', 1)
        ->where('quantity', '>', 0)
        ->whereIn('processor_type', ['n/a', $tecnologia])
        ->select('title', 'slug')->pluck('title', 'slug')
        ->prepend('Selecciona el Disco Duro', '');

        $chasis = Product::whereHas('product_categories', function($query){
            $query->whereIn('nombre', ['CAJAS / CHASIS']);
        })->where('published', 1)
        ->where('quantity', '>', 0)
        ->whereIn('processor_type', ['n/a', $tecnologia])
        ->select('title', 'slug')->pluck('title', 'slug')
        ->prepend('Selecciona el Gabinete', '');

        $fuente = Product::whereHas('product_categories', function($query){
            $query->whereIn('nombre', ['FUENTE DE PODER']);
        })->where('published', 1)
        ->where('quantity', '>', 0)
        ->whereIn('processor_type', ['n/a', $tecnologia])
        ->select('title', 'slug')->pluck('title', 'slug')
        ->prepend('Selecciona la Fuente de Poder', '');

        $refri = Product::whereHas('product_categories', function($query){
            $query->whereIn('nombre', ['REFRIGERACIÓN']);
        })->where('published', 1)
        ->where('quantity', '>', 0)
        ->whereIn('processor_type', ['n/a', $tecnologia])
        ->select('title', 'slug')->pluck('title', 'slug')
        ->prepend('Selecciona la Refrigeración', '');

        $mouse = Product::whereHas('product_categories', function($query1){
            $query1->whereHas('filters', function($query2){
                $query2->whereIn('nombre', ['MOUSE']);
            });
        })->where('published', 1)
        ->where('quantity', '>', 0)
        ->whereIn('processor_type', ['n/a', $tecnologia])
        ->select('title', 'slug')->pluck('title', 'slug')
        ->prepend('Selecciona el Mouse', '');

        $teclado = Product::whereHas('product_categories', function($query1){
            $query1->whereHas('filters', function($query2){
                $query2->whereIn('nombre', ['TECLADOS']);
            });
        })->where('published', 1)
        ->where('quantity', '>', 0)
        ->whereIn('processor_type', ['n/a', $tecnologia])
        ->select('title', 'slug')->pluck('title', 'slug')
        ->prepend('Selecciona el Teclado', '');

        $monitor = Product::whereHas('product_categories', function($query){
            $query->whereIn('nombre', ['MONITORES']);
        })->where('published', 1)
        ->where('quantity', '>', 0)
        ->whereIn('processor_type', ['n/a', $tecnologia])
        ->select('title', 'slug')->pluck('title', 'slug')
        ->prepend('Selecciona el Monitor', '');

        $accesorio = Product::whereHas('product_categories', function($query){
            $query->whereIn('nombre', ['ACCESORIOS']);
        })->where('published', 1)
        ->where('quantity', '>', 0)
        ->whereIn('processor_type', ['n/a', $tecnologia])
        ->select('title', 'slug')->pluck('title', 'slug')
        ->prepend('Selecciona el Periférico Adicional', '');

        $armado = ["NO" => 'Sin Servicio de Armado', 'SI' => 'Incluye Servicio de Armado'];

        return view('user.products.armar-pc', compact('tecnologia', 'processors', 'tvideo', 'tred', 'hdd', 'ssd', 'chasis', 'fuente', 'refri', 'mouse', 'teclado', 'monitor', 'accesorio', 'armado'));
    }

    function quick_look($slug){
        $product = Product::where('slug', $slug)->where('published', 1)->with(['discounts' => function ($query){
            $query->where('estado', 1)->where('fecha_inicio', '<=', date('Y-m-d 00:00:00'))->where('fecha_fin', '>=', date('Y-m-d 23:59:59'))->where('codigo', null)->where('tipo_cupon', 'normal')->select('id','discount')->orderBy('created_at');
        }, 'images'])->first();

        if ($product) {
            $product = $this->formato_productos($product);
        }

        return view('user.products.quicklook', compact('product'));
    }

    function quick_build($slug){
        $product = Product::where('slug', $slug)->where('published', 1)->with(['discounts' => function ($query){
            $query->where('estado', 1)->where('fecha_inicio', '<=', date('Y-m-d 00:00:00'))->where('fecha_fin', '>=', date('Y-m-d 23:59:59'))->where('codigo', null)->where('tipo_cupon', 'normal')->select('id','discount')->orderBy('created_at');
        }, 'images'])->first();

        if ($product) {
            $product = $this->formato_productos($product);
        }

        return view('user.products.quickbuild', compact('product'));
    }

    private function formato_productos($product){
        $product->links = Share::load(url('product/'.$product->slug), $product->title.' en Tauret Computadores')->services();

        if(count($product->discounts) > 0) {
            $product->discount_percent = $product->discounts->first()->discount;
            $product->discount_price = round($product->price - ($product->price * ($product->discounts->first()->discount / 100)));
        }
        $product->image = $product->images->first()['link_imagen'];

        return $product;
    }

    public function search_product(Request $request){
        if ($request->has('product_search_slug')) {
            $product = Product::where('slug', trim($request->product_search_slug))->where('published', 1)->get();
            if ($product) {
                return redirect('product/'.trim($request->product_search_slug));
            } else {
                throw new \Exception("No se encuentra el Producto Asignado", 1);
            }
        }
        else
        {
            if ($request->has('product_search'))
            {
                $search = explode('-', slugify_text($request->product_search));

                $products = Product::whereHas('product_categories', function($query) use($search){
                    foreach($search as $key => $s) {
                        if ($key == 0) {
                            $query->where('nombre', 'LIKE', '%'.$s.'%');
                        } else {
                            $query->orWhere('nombre', 'LIKE', '%'.$s.'%');
                        }
                    }
                })->orWhereHas('filters', function($query) use($search){
                    $query->whereIn('nombre', $search);
                })->orWhereHas('tags', function($query) use($search){
                    $query->whereIn('nombre', $search);
                })
                ->where('published', 1)
                ->with(['discounts' => function ($query){
                    $query->where('estado', 1)->where('fecha_inicio', '<=', date('Y-m-d 00:00:00'))->where('fecha_fin', '>=', date('Y-m-d 23:59:59'))->where('codigo', null)->where('tipo_cupon', 'normal')->select('id','discount')->orderBy('created_at');
                }, 'images'])->get();

                foreach ($products as $product) {
                    $product = $this->formato_productos($product);
                }
                
                

                if($products->count() == 0)
                {
                    $newSearch = Product::where('slug','like', "%".trim($request->product_search)."%")->where('published', 1)->get()->take('30');
                    if ($newSearch)
                    {
                        $products = $newSearch;
                        return view('user.products.search', compact('products'));
                    }
                    else
                    {
                        $category = ProductSubcategory::where('slug','like',"%".$request->product_search."%")->first();
                        if($category)
                        {
                            $products = Product::whereHas('product_categories', function($q) use ($categoria){
                                            $q->where('slug', $categoria)->where('estado',1);
                                        })->where('published', 1)->with(['discounts' => function ($query){
                                            $query->where('estado', 1)->where('fecha_inicio', '<=', date('Y-m-d 00:00:00'))->where('fecha_fin', '>=', date('Y-m-d 23:59:59'))->where('codigo', null)->where('tipo_cupon', 'normal')->select('id','discount')->orderBy('created_at');
                                        }, 'images'])->get();
                                   
                            return view('user.products.search', compact('products'));
                        }

                    }
                    Session::flash('message-error', 'No se han encontrado resultados para esta busqueda');
                    return redirect()->back();
                }

                return view('user.products.search', compact('products'));
            }
            else
            {
                Session::flash('message-error', 'Debes llenar en su totalidad el formulario');
                return redirect()->back();
            }
        }
    }

    public function special($slug){
        $product = Product::where('slug', $slug)->where('published', 1)->with(['discounts' => function ($query){
            $query->where('estado', 1)->where('fecha_inicio', '<=', date('Y-m-d 00:00:00'))->where('fecha_fin', '>=', date('Y-m-d 23:59:59'))->where('codigo', null)->where('tipo_cupon', 'normal')->select('id','discount')->orderBy('created_at');
        }, 'images', 'additional'])->first();

        if (!$product) {
            return redirect('/');
        } else {
            $product = $this->formato_productos($product);
        }

        return view('user.products.special', compact('product'));
    }
}
