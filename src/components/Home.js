import React, { useState, useEffect, useContext } from 'react';
import axios from 'axios';
import { Link, useNavigate } from 'react-router-dom';
import { UserContext } from './UserContext';

function Home1() {
  const [products, setProducts] = useState([]);
  const navigate = useNavigate();
  const { addToCart } = useContext(UserContext);
  console.log(addToCart)


  useEffect(() => {
    axios.get('http://localhost/laravel8/laravel8/public/api/product')
      .then(response => {
        if (response.data && Array.isArray(response.data.data)) {
          setProducts(response.data.data);
        } else {
          console.error('Unexpected response format:', response.data);
        }
      })
      .catch(error => {
        console.error('There was an error fetching the products!', error);
      });
  }, []);

  const handleAddToCart = (product) => {
    const cart = JSON.parse(localStorage.getItem('cart')) || {};
    const productId = product.id;

    if (cart[productId]) {
      cart[productId] += 1;
    } else {
      cart[productId] = 1;
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    addToCart();
    // navigate('/product/cart');
  };

  return (
    <div>
      <section id="slider">{/*slider*/}
        <div className="container">
          <div className="row">
          </div>
        </div>
      </section>{/*/slider*/}
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
                          Iphone
                        </a>
                      </h4>
                    </div>
                  </div>
                  <div className="panel panel-default">
                    <div className="panel-heading">
                      <h4 className="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#mens">
                          Samsung
                        </a>
                      </h4>
                    </div>
                  </div>
                  <div className="panel panel-default">
                    <div className="panel-heading">
                      <h4 className="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#mens">
                          nokia
                        </a>
                      </h4>
                    </div>
                  </div>
                </div>{/*/category-products*/}

                <div className="brands_products">{/*brands_products*/}
                  <h2>Brands</h2>
                  <div className="brands-name">
                    <ul className="nav nav-pills nav-stacked">
                      <li><a href="#"> IPHONE 11</a></li>
                      <li><a href="#"> IPHONE 14</a></li>
                      <li><a href="#"> GALAXY S5</a></li>
                      <li><a href="#"> MACBOOK AIR</a></li>
                    </ul>
                  </div>
                </div>{/*/brands_products*/}
                <div className="shipping text-center">{/*shipping*/}
                  <img src="images/home/shipping.jpg" alt="" />
                </div>{/*/shipping*/}
              </div>
            </div>
            <div className="col-sm-9 padding-right">
              <div className="features_items">
                <h2 className="title text-center">Features Items</h2>
                {products.map(product => {
                  const images = JSON.parse(product.image || '[]');
                  const mainImage = images.length > 0 ? images[0] : '';

                  return (
                    <div className="col-sm-4" key={product.id}>
                      <div className="product-image-wrapper">
                        <div className="single-products">
                          <div className="productinfo text-center">
                            <img
                              src={`http://localhost/laravel8/laravel8/public/upload/product/${product.id_user}/${mainImage}`}
                              alt={product.name}
                              style={{ width: '242px', height: '252px' }}
                            />
                            <h2>${product.price}</h2>
                            <p>{product.name}</p>
                            <button
                              className="btn btn-default add-to-cart"
                              onClick={() => handleAddToCart(product)}
                            >
                              <i className="fa fa-shopping-cart" />Add to cart
                            </button>
                          </div>
                          <div className="product-overlay">
                            <div className="overlay-content">
                              <h2>${product.price}</h2>
                              <p>{product.name}</p>
                              <button
                                className="btn btn-default add-to-cart"
                                onClick={() => handleAddToCart(product)}
                              >
                                <i className="fa fa-shopping-cart" />Add to cart
                              </button>
                            </div>
                          </div>
                          <img 
                            src="http://localhost/laravel8/laravel8/public/upload/icon/new.png"
                            className="new"
                            alt="New"
                          />
                        </div>
                        <div className="choose">
                          <ul className="nav nav-pills nav-justified">
                            <li><Link to="#"><i className="fa fa-plus-square" />Add to wishlist</Link></li>
                            <li><Link to={`/product/detail/${product.id}`}><i className="fa fa-plus-square" />More</Link></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  );
                })}
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}

export default Home1;
