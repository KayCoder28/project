import React, { useState, useEffect } from 'react';
import axios from 'axios';
import Error from '../Error/FormError';

function ProductAdd() {
  const [formList, setFormList] = useState({
    category: '',
    brand: '',
    name: '',
    price: '',
    status: '1',
    sale: '',
    detail: '',
    company: ''
  });
  const [categories, setCategories] = useState([]);
  const [brands, setBrands] = useState([]);
  const [errors, setErrors] = useState({});
  const [successMessage, setSuccessMessage] = useState('');
  const [errorMessage, setErrorMessage] = useState('');
  const [getImg, setImg] = useState([]);


  useEffect(() => {
    axios.get('http://localhost/laravel8/laravel8/public/api/category-brand')
      .then(response => {
        if (response.data && response.data.category) {
          setCategories(response.data.category);
        }
        if (response.data && response.data.brand) {
          setBrands(response.data.brand);
        }
      })
      .catch(error => {
        setErrorMessage('Lỗi khi nạp categories và brands');
      });
  }, []);

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormList(state => ({...state,[name]: value}));
  };

  const handleFileChange = (e) => {
    setImg(e.target.files);
  };

  const validateForm = () => {
    let errorsSubmit = {};
    let flag = true;
  
    if (!formList.category) {
      errorsSubmit.category = 'Vui lòng chọn Category';
      flag = false;
    }
  
    if (!formList.brand) {
      errorsSubmit.brand = 'Vui lòng chọn Brand';
      flag = false;
    }
  
    if (!formList.name) {
      errorsSubmit.name = 'Vui lòng chọn Name';
      flag = false;
    }
  
    if (getImg.length === 0) {
      errorsSubmit.avatar = ['Vui lòng chọn ít nhất 1 ảnh'];
      flag = false;
    } else if (getImg.length > 3) {
      errorsSubmit.avatar = ['Chỉ có thể tải tối đa 3 ảnh'];
      flag = false;
    } else {
      let imageError = '';
      Array.from(getImg).map(file => {
        if (!file.type.match('image/jpeg|image/png|image/jpg')) {
          imageError = 'Chỉ cho phép các tệp hình ảnh';
        } else if (file.size > 1024 * 1024) {
          imageError = 'Size ảnh phải nhỏ hơn 1MB';
        }
        return null;
      });
  
      if (imageError) {
        errorsSubmit.avatar = [imageError];
        flag = false;
      }
    }
  
    if (!formList.price) {
      errorsSubmit.price = 'Vui lòng nhập Price';
      flag = false;
    }
  
    if (!formList.detail) {
      errorsSubmit.detail = 'Vui lòng nhập Detail';
      flag = false;
    }
  
    if (!formList.company) {
      errorsSubmit.company = 'Vui lòng nhập Company';
      flag = false;
    }
  
    if (formList.status === '0' && !formList.sale) {
      errorsSubmit.sale = 'Vui lòng nhập Sale price nếu Sale';
      flag = false;
    }
  
    setErrors(errorsSubmit);
    return flag;
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    if (validateForm()) {
      let accessToken = localStorage.getItem('token');
      if (accessToken && (accessToken.startsWith('"') || accessToken.startsWith('{'))) {
        try {
          accessToken = JSON.parse(accessToken);
        } catch (error) {
          setErrorMessage('Token không hợp lệ');
          return;
        }
      }

      if (!accessToken) {
        setErrorMessage('Token không tồn tại');
        return;
      }

      const config = {
        headers: {
          'Authorization': 'Bearer ' + accessToken,
          'Content-Type': 'multipart/form-data',
          'Accept': 'application/json'
        }
      };

      let formData = new FormData();
      formData.append('category', formList.category);
      formData.append('brand', formList.brand);
      formData.append('name', formList.name);
      formData.append('price', formList.price);
      formData.append('status', formList.status);
      if (formList.status === '0') {
        formData.append('sale', formList.sale);
      }
      formData.append('detail', formList.detail);
      formData.append('company', formList.company);

      Object.keys(getImg).map((item) => {
        formData.append('file[]', getImg[item]);
      });

      axios.post('http://localhost/laravel8/laravel8/public/api/user/product/add', formData, config)
        .then(response => {
          console.log(response)
          setSuccessMessage('Thêm sản phẩm thành công');
        })
        .catch(error => {
          setErrorMessage('Lỗi khi thêm sản phẩm');
        });
    }
  };

  const renderCategory = () => {
    return categories.map(category => {
      return (
        <option key={category.id} value={category.id}>{category.category}</option>
      );
    });
  };

  const renderBrand = () => {
    return brands.map(brand => {
      return (
        <option key={brand.id} value={brand.id}>{brand.brand}</option>
      );
    });
  };

  return (
    <div className="card">
      <div className="card-header"><h3>Add Product</h3></div>
      <br />
      <div className="card-body">
        {successMessage && <div className="alert alert-success">{successMessage}</div>}
        {errorMessage && <div className="alert alert-danger">{errorMessage}</div>}
        <Error errors={errors} />
        <form onSubmit={handleSubmit} encType='multipart/form-data'>

          <div className="form-group col-md-12">
            <select name="category" value={formList.category} onChange={handleInputChange} className="form-control">
              <option value="">Please select category</option>
              {renderCategory()}
            </select>
            {errors.category && <p style={{ color: 'red' }}>{errors.category}</p>}
          </div>
          <div className="form-group col-md-12">
            <select name="brand" value={formList.brand} onChange={handleInputChange} className="form-control">
              <option value="">Please select brand</option>
              {renderBrand()}
            </select>
            {errors.brand && <p style={{ color: 'red' }}>{errors.brand}</p>}
          </div>
          <div className="form-group col-md-12">
            <input
              type="text"
              name="name"
              className="form-control"
              placeholder="Name"
              value={formList.name}
              onChange={handleInputChange}
            />
            {errors.name && <p style={{ color: 'red' }}>{errors.name}</p>}
          </div>
          <div className="form-group col-md-12">
            <input
              type="file"
              name="avatar"
              className="form-control"
              multiple
              onChange={handleFileChange}
            />
            {errors.avatar && <p style={{ color: 'red' }}>{errors.avatar}</p>}
          </div>
          <div className="form-group col-md-12">
            <input
              type="text"
              name="price"
              className="form-control"
              placeholder="Price"
              value={formList.price}
              onChange={handleInputChange}
            />
            {errors.price && <p style={{ color: 'red' }}>{errors.price}</p>}
          </div>
          <div className="form-group col-md-12">
            <div>Status of product</div>
            <input
              type="radio"
              id="new"
              name="status"
              value="1"
              checked={formList.status === '1'}
              onChange={handleInputChange}
            /> New
            <input
              type="radio"
              id="sale"
              name="status"
              value="0"
              checked={formList.status === '0'}
              onChange={handleInputChange}
            /> Sale
            {formList.status === '0' && (
              <input
                type="text"
                name="sale"
                placeholder="Sale price"
                value={formList.sale}
                onChange={handleInputChange}
              />
            )}
            {errors.sale && <p style={{ color: 'red' }}>{errors.sale}</p>}
          </div>
          <div className="form-group col-md-12">
            <textarea
              name="detail"
              className="form-control"
              placeholder="Detail"
              value={formList.detail}
              onChange={handleInputChange}
            />
            {errors.detail && <p style={{ color: 'red' }}>{errors.detail}</p>}
          </div>
          <div className="form-group col-md-12">
            <textarea
              name="company"
              className="form-control"
              placeholder="Company profile"
              value={formList.company}
              onChange={handleInputChange}
            />
            {errors.company && <p style={{ color: 'red' }}>{errors.company}</p>}
          </div>
          <div className="form-group col-md-12">
            <input type="submit" value="Add Product" className="btn btn-danger" />
          </div>
        </form>
      </div>
    </div>
  );
}

export default ProductAdd;
