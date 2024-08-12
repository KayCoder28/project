import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import axios from 'axios';

function ProductDetail() {
  const { id } = useParams();
  const [product, setProduct] = useState(null);

  useEffect(() => {
    axios.get(`http://localhost/laravel8/laravel8/public/api/product/detail/${id}`)
      .then(response => {
        const productData = response.data.data;
        productData.images = JSON.parse(productData.image || '[]');
        setProduct(productData);
      })
      .catch(error => {
        console.error('Lỗi khi nạp sản phẩm', error);
      });
  }, [id]);

  if (!product) {
    return <div>Loading...</div>;
  }
    return(
        <section>
        <div className="container">
          <div className="row">
            <div className="col-sm-3">
              <div className="left-sidebar">
                <h2>Category</h2>
                <div className="panel-group category-products" id="accordian">{/*category-productsr*/}
                  <div className="panel panel-default">
                    <div className="panel-heading">
                      <h4 className="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                          <span className="badge pull-right"><i className="fa fa-plus" /></span>
                          Sportswear
                        </a>
                      </h4>
                    </div>
                    <div id="sportswear" className="panel-collapse collapse">
                      <div className="panel-body">
                        <ul>
                          <li><a href>Nike </a></li>
                          <li><a href>Under Armour </a></li>
                          <li><a href>Adidas </a></li>
                          <li><a href>Puma</a></li>
                          <li><a href>ASICS </a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div className="panel panel-default">
                    <div className="panel-heading">
                      <h4 className="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#mens">
                          <span className="badge pull-right"><i className="fa fa-plus" /></span>
                          Mens
                        </a>
                      </h4>
                    </div>
                    <div id="mens" className="panel-collapse collapse">
                      <div className="panel-body">
                        <ul>
                          <li><a href>Fendi</a></li>
                          <li><a href>Guess</a></li>
                          <li><a href>Valentino</a></li>
                          <li><a href>Dior</a></li>
                          <li><a href>Versace</a></li>
                          <li><a href>Armani</a></li>
                          <li><a href>Prada</a></li>
                          <li><a href>Dolce and Gabbana</a></li>
                          <li><a href>Chanel</a></li>
                          <li><a href>Gucci</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div className="panel panel-default">
                    <div className="panel-heading">
                      <h4 className="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#womens">
                          <span className="badge pull-right"><i className="fa fa-plus" /></span>
                          Womens
                        </a>
                      </h4>
                    </div>
                    <div id="womens" className="panel-collapse collapse">
                      <div className="panel-body">
                        <ul>
                          <li><a href>Fendi</a></li>
                          <li><a href>Guess</a></li>
                          <li><a href>Valentino</a></li>
                          <li><a href>Dior</a></li>
                          <li><a href>Versace</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div className="panel panel-default">
                    <div className="panel-heading">
                      <h4 className="panel-title"><a href="#">Kids</a></h4>
                    </div>
                  </div>
                  <div className="panel panel-default">
                    <div className="panel-heading">
                      <h4 className="panel-title"><a href="#">Fashion</a></h4>
                    </div>
                  </div>
                  <div className="panel panel-default">
                    <div className="panel-heading">
                      <h4 className="panel-title"><a href="#">Households</a></h4>
                    </div>
                  </div>
                  <div className="panel panel-default">
                    <div className="panel-heading">
                      <h4 className="panel-title"><a href="#">Interiors</a></h4>
                    </div>
                  </div>
                  <div className="panel panel-default">
                    <div className="panel-heading">
                      <h4 className="panel-title"><a href="#">Clothing</a></h4>
                    </div>
                  </div>
                  <div className="panel panel-default">
                    <div className="panel-heading">
                      <h4 className="panel-title"><a href="#">Bags</a></h4>
                    </div>
                  </div>
                  <div className="panel panel-default">
                    <div className="panel-heading">
                      <h4 className="panel-title"><a href="#">Shoes</a></h4>
                    </div>
                  </div>
                </div>{/*/category-products*/}
                <div className="brands_products">{/*brands_products*/}
                  <h2>Brands</h2>
                  <div className="brands-name">
                    <ul className="nav nav-pills nav-stacked">
                      <li><a href> <span className="pull-right">(50)</span>Acne</a></li>
                      <li><a href> <span className="pull-right">(56)</span>Grüne Erde</a></li>
                      <li><a href> <span className="pull-right">(27)</span>Albiro</a></li>
                      <li><a href> <span className="pull-right">(32)</span>Ronhill</a></li>
                      <li><a href> <span className="pull-right">(5)</span>Oddmolly</a></li>
                      <li><a href> <span className="pull-right">(9)</span>Boudestijn</a></li>
                      <li><a href> <span className="pull-right">(4)</span>Rösch creative culture</a></li>
                    </ul>
                  </div>
                </div>{/*/brands_products*/}
                <div className="price-range">{/*price-range*/}
                  <h2>Price Range</h2>
                  <div className="well">
                    <input type="text" className="span2" defaultValue data-slider-min={0} data-slider-max={600} data-slider-step={5} data-slider-value="[250,450]" id="sl2" /><br />
                    <b>$ 0</b> <b className="pull-right">$ 600</b>
                  </div>
                </div>{/*/price-range*/}
                <div className="shipping text-center">{/*shipping*/}
                  <img src="images/home/shipping.jpg" alt="" />
                </div>{/*/shipping*/}
              </div>
            </div>
            <div className="col-sm-9">
            <div className="product-details">
              <div className="col-sm-5">
                <div className="view-product">
                  {product.images && product.images.map((img, index) => (
                    <img
                      key={index}
                      src={`http://localhost/laravel8/laravel8/public/upload/product/${product.id_user}/${img}`}
                      alt={`Product ${index + 1}`}
                      style={{ width: '100%', marginBottom: '10px' }}
                    />
                  ))}
                  {product.images && product.images.length > 0 && (
                    <a href={`http://localhost/laravel8/laravel8/public/upload/product/${product.id_user}/${product.images[0]}`} rel="prettyPhoto">
                      <h3>ZOOM</h3>
                    </a>
                  )}
                </div>
              </div>
              <div className="col-sm-7">
                <div className="product-information">
                  <img src="images/product-details/new.jpg" className="newarrival" alt="" />
                  <h2>{product.name}</h2>
                  <p>Web ID: {product.id}</p>
                  <img src="images/product-details/rating.png" alt="" />
                  <span>
                    <span>{product.price}</span>
                    <button type="button" className="btn btn-fefault cart">
                      <i className="fa fa-shopping-cart" />
                      Add to cart
                    </button>
                  </span>
                  <p><b>Availability:</b> {product.status ? 'In Stock' : 'Out of Stock'}</p>
                  <p><b>Condition:</b> {product.condition}</p>
                  <p><b>Brand:</b> {product.id_brand}</p>
                  <p><b>Description:</b> {product.detail}</p>
                  <a href="#"><img src="images/product-details/share.png" className="share img-responsive" alt="" /></a>
                </div>
              </div>
            </div>
            <div className="category-tab shop-details-tab">{/*category-tab*/}
            <div className="col-sm-12">
              <ul className="nav nav-tabs">
                <li><a href="#details" data-toggle="tab">Details</a></li>
                <li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
                <li><a href="#tag" data-toggle="tab">Tag</a></li>
                <li className="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
              </ul>
            </div>
            <div className="tab-content">
              <div className="tab-pane fade" id="details">
                <div className="col-sm-3">
                  <div className="product-image-wrapper">
                    <div className="single-products">
                      <div className="productinfo text-center">
                        <img src="images/home/gallery1.jpg" alt="" />
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <button type="button" className="btn btn-default add-to-cart"><i className="fa fa-shopping-cart" />Add to cart</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="col-sm-3">
                  <div className="product-image-wrapper">
                    <div className="single-products">
                      <div className="productinfo text-center">
                        <img src="images/home/gallery2.jpg" alt="" />
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <button type="button" className="btn btn-default add-to-cart"><i className="fa fa-shopping-cart" />Add to cart</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="col-sm-3">
                  <div className="product-image-wrapper">
                    <div className="single-products">
                      <div className="productinfo text-center">
                        <img src="images/home/gallery3.jpg" alt="" />
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <button type="button" className="btn btn-default add-to-cart"><i className="fa fa-shopping-cart" />Add to cart</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="col-sm-3">
                  <div className="product-image-wrapper">
                    <div className="single-products">
                      <div className="productinfo text-center">
                        <img src="images/home/gallery4.jpg" alt="" />
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <button type="button" className="btn btn-default add-to-cart"><i className="fa fa-shopping-cart" />Add to cart</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="tab-pane fade" id="companyprofile">
                <div className="col-sm-3">
                  <div className="product-image-wrapper">
                    <div className="single-products">
                      <div className="productinfo text-center">
                        <img src="images/home/gallery1.jpg" alt="" />
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <button type="button" className="btn btn-default add-to-cart"><i className="fa fa-shopping-cart" />Add to cart</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="col-sm-3">
                  <div className="product-image-wrapper">
                    <div className="single-products">
                      <div className="productinfo text-center">
                        <img src="images/home/gallery3.jpg" alt="" />
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <button type="button" className="btn btn-default add-to-cart"><i className="fa fa-shopping-cart" />Add to cart</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="col-sm-3">
                  <div className="product-image-wrapper">
                    <div className="single-products">
                      <div className="productinfo text-center">
                        <img src="images/home/gallery2.jpg" alt="" />
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <button type="button" className="btn btn-default add-to-cart"><i className="fa fa-shopping-cart" />Add to cart</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="col-sm-3">
                  <div className="product-image-wrapper">
                    <div className="single-products">
                      <div className="productinfo text-center">
                        <img src="images/home/gallery4.jpg" alt="" />
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <button type="button" className="btn btn-default add-to-cart"><i className="fa fa-shopping-cart" />Add to cart</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="tab-pane fade" id="tag">
                <div className="col-sm-3">
                  <div className="product-image-wrapper">
                    <div className="single-products">
                      <div className="productinfo text-center">
                        <img src="images/home/gallery1.jpg" alt="" />
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <button type="button" className="btn btn-default add-to-cart"><i className="fa fa-shopping-cart" />Add to cart</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="col-sm-3">
                  <div className="product-image-wrapper">
                    <div className="single-products">
                      <div className="productinfo text-center">
                        <img src="images/home/gallery2.jpg" alt="" />
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <button type="button" className="btn btn-default add-to-cart"><i className="fa fa-shopping-cart" />Add to cart</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="col-sm-3">
                  <div className="product-image-wrapper">
                    <div className="single-products">
                      <div className="productinfo text-center">
                        <img src="images/home/gallery3.jpg" alt="" />
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <button type="button" className="btn btn-default add-to-cart"><i className="fa fa-shopping-cart" />Add to cart</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="col-sm-3">
                  <div className="product-image-wrapper">
                    <div className="single-products">
                      <div className="productinfo text-center">
                        <img src="images/home/gallery4.jpg" alt="" />
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <button type="button" className="btn btn-default add-to-cart"><i className="fa fa-shopping-cart" />Add to cart</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="tab-pane fade active in" id="reviews">
                <div className="col-sm-12">
                  <ul>
                    <li><a href><i className="fa fa-user" />EUGEN</a></li>
                    <li><a href><i className="fa fa-clock-o" />12:41 PM</a></li>
                    <li><a href><i className="fa fa-calendar-o" />31 DEC 2014</a></li>
                  </ul>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                  <p><b>Write Your Review</b></p>
                  <form action="#">
                    <span>
                      <input type="text" placeholder="Your Name" />
                      <input type="email" placeholder="Email Address" />
                    </span>
                    <textarea name defaultValue={""} />
                    <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                    <button type="button" className="btn btn-default pull-right">
                      Submit
                    </button>
                  </form>
                </div>
              </div>
            </div>
            </div>
          </div>
          </div>
        </div>
      </section>
    )
}
export default ProductDetail