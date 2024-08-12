import React, { useEffect, useState } from 'react';
import axios from 'axios';

function Cart() {
  const [cartProducts, setCartProducts] = useState([]);

  useEffect(() => {
    const cart = JSON.parse(localStorage.getItem('cart')) || {};
    axios.post('http://localhost/laravel8/laravel8/public/api/product/cart', cart)
      .then(response => {
        if (response.data && response.data.data && Array.isArray(response.data.data)) {
          setCartProducts(response.data.data);
        } else {
          console.error( response.data);
        }
      })
      .catch(error => {
        console.error('Lỗi khi thêm sản phẩm vào giỏ hàng', error);
      });
  }, []);

  const tangQuantity = (id) => {
    const updatedCart = cartProducts.map(product =>
      product.id === id ? { ...product, qty: product.qty + 1 } : product
    );
    
    setCartProducts(updatedCart);
    updateLocalStorage(updatedCart);
  };

  const giamQuantity = (id) => {
    const updatedCart = cartProducts.map(product => {
      if (product.id === id && product.qty > 1) {
        return { ...product, qty: product.qty - 1 };
      }
      return product;
    });

    setCartProducts(updatedCart);
    updateLocalStorage(updatedCart);
  };
  

  const removeProduct = (id) => {
    const updatedCart = cartProducts.reduce((acc, product) => {
      if (product.id !== id) {
        acc.push(product);
      }
      return acc;
    }, []);
  
    setCartProducts(updatedCart);
    updateLocalStorage(updatedCart);
  };
  

  const updateLocalStorage = (updatedCart) => {
    const cartDataArray = updatedCart.map(product => [product.id, product.qty]);
  
    const cartData = Object.fromEntries(cartDataArray);
  
    localStorage.setItem('cart', JSON.stringify(cartData));
  };
  

  return (
    <div>
      <section id="cart_items">
        <div className="container">
          <div className="breadcrumbs">
            <ol className="breadcrumb">
              <li><a href="#">Home</a></li>
              <li className="active">Shopping Cart</li>
            </ol>
          </div>
          <div className="table-responsive cart_info">
            <table className="table table-condensed">
              <thead>
                <tr className="cart_menu">
                  <td className="image">Item</td>
                  <td className="description" />
                  <td className="price">Price</td>
                  <td className="quantity">Quantity</td>
                  <td className="total">Total</td>
                  <td />
                </tr>
              </thead>
              <tbody>
                {cartProducts.map(product => {
                  const images = JSON.parse(product.image || '[]');
                  const mainImage = images.length > 0 ? images[0] : '';

                  return (
                    <tr key={product.id}>
                      <td className="cart_product">
                        <a href="#">
                          <img
                            src={`http://localhost/laravel8/laravel8/public/upload/product/${product.id_user}/${mainImage}`}
                            alt={product.name}
                            style={{ width: '50px', height: '50px' }}
                          />
                        </a>
                      </td>
                      <td className="cart_description">
                        <h4><a href="#">{product.name}</a></h4>
                        <p>Product ID: {product.id}</p>
                      </td>
                      <td className="cart_price">
                        <p>${product.price}</p>
                      </td>
                      <td className="cart_quantity">
                        <div className="cart_quantity_button">
                          <a className="cart_quantity_up" href="#" onClick={() => tangQuantity(product.id)}> + </a>
                          <input className="cart_quantity_input" type="text" name="quantity" value={product.qty} readOnly />
                          <a className="cart_quantity_down" href="#" onClick={() => giamQuantity(product.id)}> - </a>
                        </div>
                      </td>
                      <td className="cart_total">
                        <p className="cart_total_price">${product.price * product.qty}</p>
                      </td>
                      <td className="cart_delete">
                        <a className="cart_quantity_delete" href="#" onClick={() => removeProduct(product.id)}><i className="fa fa-times" /></a>
                      </td>
                    </tr>
                  );
                })}
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <section id="do_action">
        <div className="container">
          <div className="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
          </div>
          <div className="row">
            <div className="col-sm-6">
              <div className="chose_area">
                <ul className="user_option">
                  <li>
                    <input type="checkbox" />
                    <label>Use Coupon Code</label>
                  </li>
                  <li>
                    <input type="checkbox" />
                    <label>Use Gift Voucher</label>
                  </li>
                  <li>
                    <input type="checkbox" />
                    <label>Estimate Shipping &amp; Taxes</label>
                  </li>
                </ul>
                <ul className="user_info">
                  <li className="single_field">
                    <label>Country:</label>
                    <select>
                      <option>United States</option>
                      <option>Bangladesh</option>
                      <option>UK</option>
                      <option>India</option>
                      <option>Pakistan</option>
                      <option>Ucrane</option>
                      <option>Canada</option>
                      <option>Dubai</option>
                    </select>
                  </li>
                  <li className="single_field">
                    <label>Region / State:</label>
                    <select>
                      <option>Select</option>
                      <option>Dhaka</option>
                      <option>London</option>
                      <option>Dillih</option>
                      <option>Lahore</option>
                      <option>Alaska</option>
                      <option>Canada</option>
                      <option>Dubai</option>
                    </select>
                  </li>
                  <li className="single_field zip-field">
                    <label>Zip Code:</label>
                    <input type="text" />
                  </li>
                </ul>
                <a className="btn btn-default update" href="#">Get Quotes</a>
                <a className="btn btn-default check_out" href="#">Continue</a>
              </div>
            </div>
            <div className="col-sm-6">
              <div className="total_area">
                <ul>
                  <li>Cart Sub Total <span>$59</span></li>
                  <li>Eco Tax <span>$2</span></li>
                  <li>Shipping Cost <span>Free</span></li>
                  <li>Total <span>$61</span></li>
                </ul>
                <a className="btn btn-default update" href="#">Update</a>
                <a className="btn btn-default check_out" href="#">Check Out</a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}

export default Cart;
