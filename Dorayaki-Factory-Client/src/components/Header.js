import React from 'react'

const Header = () => {
    return (
        <nav className="navbar is-dark" role="navigation" aria-label="main navigation">

        <div className="navbar-menu">
          <div className="navbar-start">
            <a className="navbar-item ml-5" href="/">
              Home
            </a>
            <a className="navbar-item" href="/recipes">
              Resep
            </a>
      
            <a className="navbar-item">
              Request
            </a>
      
            <a className="navbar-item" href="/stok">
              Bahan Baku
            </a>
          </div>
      
          <div className="navbar-end">
            <div className="navbar-item">
              <div className="buttons">
                <a className="button is-primary">
                  Register
                </a>
                <a className="button is-primary is-light">
                  Log in
                </a>
              </div>
            </div>
          </div>
        </div>
      </nav>
    )
}

export default Header
