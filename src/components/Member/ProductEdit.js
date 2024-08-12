import React, { useState, useEffect } from 'react';
import axios from 'axios';
import Error from '../Error/FormError';
import { useParams } from 'react-router-dom';

function ProductEdit() {
    const { id: productId } = useParams();
    const [formList, setFormList] = useState({
        category: '',
        brand: '',
        name: '',
        price: '',
        status: '1',
        sale: '',
        detail: '',
        company: '',
        image: '',
        id_user: ''
    });
    const [categories, setCategories] = useState([]);
    const [brands, setBrands] = useState([]);
    const [errors, setErrors] = useState({});
    const [successMessage, setSuccessMessage] = useState('');
    const [errorMessage, setErrorMessage] = useState('');
    const [getImg, setImg] = useState([]);
    const [imgDelete, setImgDelete] = useState([]);

    useEffect(() => {
        axios.get('http://localhost/laravel8/laravel8/public/api/category-brand')
            .then(response => {
              console.log(response)
                if (response.data && response.data.category) {
                    setCategories(response.data.category);
                }
                if (response.data && response.data.brand) {
                    setBrands(response.data.brand);
                }
            })
            .catch(() => {
                setErrorMessage('Lỗi khi nạp categories và brands');
            });
    }, []);

    useEffect(() => {
        const chitietProduct = () => {
            let accessToken = localStorage.getItem('token');
            if (accessToken && (accessToken.startsWith('"') || accessToken.startsWith('{'))) {
                accessToken = JSON.parse(accessToken);
            }

            if (!accessToken) {
                setErrorMessage('Token không tồn tại');
                return;
            }

            const config = {
                headers: {
                    'Authorization': 'Bearer ' + accessToken,
                    'Accept': 'application/json'
                }
            };

            axios.get(`http://localhost/laravel8/laravel8/public/api/user/product/${productId}`, config)
                .then(response => {
                  console.log('chi tiết sản phẩm:',response.data)
                    const product = response.data;
                    setFormList({
                        category: product.category_id || '',
                        brand: product.brand_id || '',
                        name: product.name || '',
                        price: product.price || '',
                        status: product.status || '',
                        sale: product.sale || '',
                        detail: product.detail || '',
                        company: product.company_profile || '',
                        image: product.data.image || '',
                        id_user: product.data.id_user || ''
                    });
                    console.log('Hình ảnh sản phẩm:', product.data.image);
                })
                .catch(() => {
                    setErrorMessage('Lỗi khi lấy chi tiết sản phẩm');
                });
        };
        chitietProduct();
    }, [productId]);

    const handleInputChange = (e) => {
        const { name, value } = e.target;
        setFormList(state => ({ ...state, [name]: value }));
    };

    const handleFileChange = (e) => {
        setImg(e.target.files);
    };

    const handleDelete = (e) => {
        const { value } = e.target;
        setImgDelete(oldArray => [...oldArray, value]);
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
  
      if ((Array.isArray(getImg) && getImg.length === 0) && (Array.isArray(formList.image) && formList.image.length === 0)) {
          errorsSubmit.avatar = ['Vui lòng chọn ít nhất 1 ảnh'];
          flag = false;
      } else if ((Array.isArray(getImg) ? getImg.length : 0) + (Array.isArray(formList.image) ? formList.image.length : 0) > 3) {
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

            imgDelete.map((item, i) => {
                formData.append('avatarCheckBox[]', item);
            });

            axios.post(`http://localhost/laravel8/laravel8/public/api/user/product/update/${productId}`, formData, config)
                .then(() => {
                    setSuccessMessage('Sản phẩm đã được cập nhật thành công');
                })
                .catch(() => {
                    setErrorMessage('Lỗi khi cập nhật sản phẩm');
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
            <div className="card-header"><h3>Edit Product</h3></div>
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
                        {formList.image && formList.image.length > 0 && (
                            <ul>
                                {formList.image.map((img, index) => (
                                    <li key={index}>
                                        <img src={`http://localhost/laravel8/laravel8/public/upload/product/${formList.id_user}/${img}`} alt={``} style={{ width: '100px', height: 'auto' }} />
                                        <input
                                            type="checkbox"
                                            name='avatarCheckBox'
                                            value={img}
                                            onClick={handleDelete}
                                        />
                                    </li>
                                ))}
                            </ul>
                        )}
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
                        <input type="submit" value="Update Product" className="btn btn-danger" />
                    </div>
                </form>
            </div>
        </div>
    );
}

export default ProductEdit;
