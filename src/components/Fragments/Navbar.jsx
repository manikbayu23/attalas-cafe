import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import React, { useState } from 'react';
import { NavLink } from 'react-router-dom';
import { faUser } from '@fortawesome/free-solid-svg-icons';
const Navbar = () => {
    const [isNavbarOpen, setNavbarOpen] = useState(false);

    const toggleNavbar = () => {
        setNavbarOpen(!isNavbarOpen);
    };
    const closeNavbar = () => {
        setNavbarOpen(false);
    };

    return (
        <div className="header">
            <nav className='navbar-cafe'>
                <NavLink to="/" className='logo-cafe'>Attalas Cafe</NavLink>
                <ul className={isNavbarOpen ? 'nav-list' : 'nav-list-close'}>
                    <li><NavLink onClick={closeNavbar} to="/" className='nav-link'>HOME</NavLink></li>
                    <li><NavLink onClick={closeNavbar} to="/menu" className='nav-link'>MENU</NavLink></li>
                    <li><NavLink onClick={closeNavbar} to="/gallery" className='nav-link'>GALLERY</NavLink></li>
                    <li><NavLink onClick={closeNavbar} to="/contact" className='nav-link'>CONTACT US</NavLink></li>
                </ul>
                <div className='togglres' >
                    <div className={isNavbarOpen ? 'btn-toggle' : ''}
                    >
                        <input
                            type="checkbox"
                            id='checkbox'
                            checked={isNavbarOpen}
                            onChange={toggleNavbar}
                        />
                        <label htmlFor="checkbox" className='toggle'>
                            <div className="bars" id='bar1'></div>
                            <div className="bars" id='bar2'></div>
                            <div className="bars" id='bar3'></div>
                        </label>
                    </div>
                </div>
            </nav>
        </div>
    )
}

export default Navbar;
