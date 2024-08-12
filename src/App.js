import React, { useState } from 'react';
import { Routes, Route, useLocation } from 'react-router-dom';
import Header from './components/Layout/Header';
import Footer from './components/Layout/Footer';
import Home1 from './components/Home';
import Blog from './components/Blog/Blog';
import BlogDetail from './components/Blog/Blogdetail';
import Register from './components/Member/Register';
import Login from './components/Member/Login';
import About from './components/Member/About';
import Contact from './components/Member/Contact';
import ProductList from './components/Member/ProductList';
import ProductAdd from './components/Member/ProductAdd';
import ProductEdit from './components/Member/ProductEdit';
import Update from './components/Member/Update';
import MenuAcc from './components/Member/AccMenu';
import MenuLeft from './components/Member/Menuleft';
import HomePage from './components/Home';
import ProductDetail from './components/product/ProductDetail';
import Cart from './components/product/productCart';
import { UserContext } from './components/UserContext';

function App() {
  const [getQty, setQty] = useState(0);

  const addToCart = () => {
    setQty(prevQty => prevQty + 1);
    localStorage.setItem("tongQty", getQty)
  };

  const location = useLocation();
  const renderMenu = () => {
    if (location.pathname.startsWith('/account')) {
      return <MenuAcc />;
    } else {
      return <MenuLeft />;
    }
  };

  return (
    <UserContext.Provider value={{ getQty , addToCart }}>
      <Header />
      <div className='container'>
        <div className='row'>
          {renderMenu()}
          <Routes>
            <Route path="/" element={<HomePage />} />
            <Route path="/Blog/list" element={<Blog />} />
            <Route path="/Blog/detail/:id" element={<BlogDetail />} />
            <Route path="/member/register" element={<Register />} />
            <Route path="/member/login" element={<Login />} />
            <Route path="/account/update" element={<Update />} />
            <Route path="/account/product/list" element={<ProductList />} />
            <Route path="/account/product/add" element={<ProductAdd />} />
            <Route path="/account/product/edit/:id" element={<ProductEdit />} />
            <Route path="/about" element={<About />} />
            <Route path="/contact" element={<Contact />} />
            <Route path="/product/detail/:id" element={<ProductDetail />} />
            <Route path="/product/cart" element={<Cart />} />
          </Routes>
        </div>
      </div>
      <Footer />
    </UserContext.Provider>
  );
}

export default App;
