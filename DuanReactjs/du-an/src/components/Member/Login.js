import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import axios from "axios";

function Login(props) {
    const navigate = useNavigate();

    const [formData, setFormData] = useState({
        email: "",
        password: "",
        level: "0"
    });

    const [errors, setErrors] = useState({});

    const handleInput = (e) => {
        const { name, value } = e.target;
        setFormData(state => ({ ...state, [name]: value }));
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        let errorsSubmit = {};
        let flag = true;

        if (!formData.email) {
            errorsSubmit.email = "Vui lòng nhập email";
            flag = false;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(formData.email)) {
            errorsSubmit.email = "Email không đúng định dạng";
            flag = false;
        }

        if (!formData.password) {
            errorsSubmit.password = "Vui lòng nhập mật khẩu";
            flag = false;
        }

        if (!flag) {
            setErrors(errorsSubmit);
            return;
        } else {
            const data = {
                email: formData.email,
                password: formData.password,
            };
            
            axios.post("http://localhost/laravel8/laravel8/public/api/login", data)
            .then((res) => {
                if (res.data.response === "error") {
                    setErrors({ email: "Email hoặc mật khẩu không đúng" });
                } else {
                    alert('Login thành công');
                    localStorage.setItem("token", res.data.token);
                    localStorage.setItem("user", JSON.stringify(res.data.Auth));
                    navigate('/');
                }
            })
            .catch((error) => {
                console.error("Error logging in:", error);
                setErrors({ email: "Đã xảy ra lỗi khi đăng nhập. Vui lòng thử lại sau." });
            });
                }
            }

    return (
        <div>
            {Object.keys(errors).length > 0 && (
                <div className="alert alert-danger">
                    {Object.values(errors).map((error, index) => (
                        <p key={index}>{error}</p>
                    ))}
                </div>
            )}
            <form onSubmit={handleSubmit}>
                <input type="text" placeholder="E-Mail Address" name="email" onChange={handleInput} />
                <input type="password" placeholder="Password" name="password" onChange={handleInput} />
                <button type="submit">Login</button>
            </form>
        </div>
    );
}

export default Login;
