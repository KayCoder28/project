import React, { useState, useEffect } from 'react';
import axios from 'axios';

function Update() {
  const [errors, setErrors] = useState({});
  const [user, setUser] = useState({
    username: '',
    email: '',
    address: '',
    phone: '',
    pass: ''
  });

  useEffect(() => {
    const userData = localStorage.getItem('appState');
    if (userData) {
      try {
        const parsedData = JSON.parse(userData);
        const userFromStorage = parsedData.user;

        if (userFromStorage && userFromStorage.auth) {
          setUser({
            username: userFromStorage.auth.name || '',
            email: userFromStorage.auth.email || '',
            address: userFromStorage.auth.address || '',
            phone: userFromStorage.auth.phone || '',
            pass: userFromStorage.auth.pass || ''
          });
        }
      } catch (error) {
        console.error('Error parsing user data:', error);
      }
    }
  }, []);

  const handleInput = (e) => {
    const { name, value } = e.target;
    setUser(prevState => ({
      ...prevState,
      [name]: value
    }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    const token = localStorage.getItem('token');
    if (!token) {
      alert('No authorization token found.');
      return;
    }

    const config = {
      headers: {
        'Authorization': 'Bearer ' + token,
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      }
    };

    axios.post('http://localhost/laravel8/laravel8/public/api/account/update', user, config)
      .then(response => {
        alert('Cập nhật thành công');
      })
      .catch(error => {
        console.error('Có lỗi xảy ra:', error);
        setErrors(error.response?.data?.errors || {});
        alert('Cập nhật thất bại');
      });
  };

  return (
    <div className="col-sm-9">
      <div className="blog-post-area">
        <h2 className="title text-center">Update User</h2>
        <div className="signup-form">
          <h2>Update User Information</h2>
          <form onSubmit={handleSubmit}>
            <div>
              <input 
                type="text" 
                name="username" 
                placeholder="Name" 
                value={user.username} 
                onChange={handleInput} 
              />
              {errors.username && <p>{errors.username}</p>}
            </div>
            <div>
              <input 
                type="email" 
                name="email" 
                placeholder="Email Address" 
                value={user.email} 
                onChange={handleInput}
              />
              {errors.email && <p>{errors.email}</p>}
            </div>
            <div>
              <input 
                type="text" 
                name="address" 
                placeholder="Address" 
                value={user.address} 
                onChange={handleInput} 
              />
              {errors.address && <p>{errors.address}</p>}
            </div>
            <div>
              <input 
                type="text" 
                name="phone" 
                placeholder="Phone" 
                value={user.phone} 
                onChange={handleInput} 
              />
              {errors.phone && <p>{errors.phone}</p>}
            </div>
            <div>
              <input 
                type="password" 
                name="pass" 
                placeholder="Password" 
                value={user.pass} 
                onChange={handleInput} 
              />
              {errors.pass && <p>{errors.pass}</p>}
            </div>
            <button type="submit" className="btn btn-default">Update</button>
          </form>
        </div>
      </div>
    </div>
  );
}

export default Update;
