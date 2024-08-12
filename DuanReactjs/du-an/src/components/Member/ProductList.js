import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

function ProductList() {
  const [products, setProducts] = useState([]);
  const [errorMessage, setErrorMessage] = useState('');
  const navigate = useNavigate();

  useEffect(() => {
    layProducts();
  }, []);

  const layProducts = async () => {
    const accessToken = localStorage.getItem('token');
    if (!accessToken) {
      setErrorMessage('Token không tồn tại');
      return;
    }

    const config = {
      headers: {
        'Authorization': 'Bearer ' + accessToken,
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      }
    };

    axios.get('http://localhost/laravel8/laravel8/public/api/user/my-product', config)
      .then(response => {
        console.log('API Response:', response.data);
        const data = response.data;
        if (data && data.data) {
          const productsArray = Object.values(data.data);
          setProducts(productsArray);
        } else {
          setProducts([]);
          setErrorMessage('Dữ liệu không hợp lệ');
        }
      })
      .catch(error => {
        setErrorMessage('Lỗi khi lấy danh sách sản phẩm');
      });
  };

  const deleteProduct = (e) => {
    const productId = e.target.id;
    console.log(productId);
    const accessToken = localStorage.getItem('token');
    if (!accessToken) {
      setErrorMessage('Token không tồn tại');
      return;
    }

    const config = {
      headers: {
        'Authorization': 'Bearer ' + accessToken,
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      }
    };

    axios.get(`http://localhost/laravel8/laravel8/public/api/user/product/delete/${productId}`, config)
      .then((res) => {
        console.log(res);
        layProducts();
      })
      .catch(error => {
        setErrorMessage('Lỗi khi xóa sản phẩm');
        console.log('có lỗi khi đang xóa sản phẩm', error);
      });
  };

  const handleEdit = (productId) => {
    navigate(`/account/product/edit/${productId}`);
  };

  const renderProducts = () => {
    if (products.length === 0) {
      return (
        <tr>
          <td colSpan="9">Không có sản phẩm nào</td>
        </tr>
      );
    }

    return products.map(product => {
      let firstImage = '';
      if (product.image) {
        const images = JSON.parse(product.image);
        if (Array.isArray(images) && images.length > 0) {
          firstImage = images[0];
        }
      }

      const imageUrl = firstImage
        ? `http://localhost/laravel8/laravel8/public/upload/product/${product.id_user}/${firstImage}`
        : 'http://localhost/laravel8/laravel8/public/upload/default-image.png';

      return (
        <tr key={product.id}>
          <td>{product.id || 'No Id'}</td>
          <td>{product.name || 'No name'}</td>
          <td>
            <img src={imageUrl} alt={product.name || 'No image'} width="100" />
          </td>
          <td>{product.price || 'No price'}</td>
          {/* <td>{product.id_category || 'No category'}</td>
          <td>{product.id_brand || 'No brand'}</td> */}
          <td>{product.status === 1 ? 'New' : 'Sale'}</td>
          <td>{product.detail || 'No detail'}</td>
          <td>{product.company_profile || 'No company'}</td>
          <td>
            <button onClick={() => handleEdit(product.id)} className="btn btn-primary">Edit</button>
            <button onClick={deleteProduct} id={product.id} className="btn btn-danger">Delete</button>
          </td>
        </tr>
      );
    });
  };

  return (
    <div>
      <h3>Product List</h3>
      {errorMessage && <div className="alert alert-danger">{errorMessage}</div>}
      <table className="table">
        <thead>
          <tr>
            <th>id</th>
            <th>Name</th>
            <th>Image</th>
            <th>Price</th>
            {/* <th>Category</th>
            <th>Brand</th> */}
            <th>Status</th>
            <th>Detail</th>
            <th>Company</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          {renderProducts()}
        </tbody>
      </table>
    </div>
  );
}

export default ProductList;
