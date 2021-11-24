import React from 'react'

const Header = () => {
    return (
        <nav class="navbar is-dark" role="navigation" aria-label="main navigation">

        <div class="navbar-menu">
          <div class="navbar-start">
            <a class="navbar-item">
              Resep
            </a>
      
            <a class="navbar-item">
              Stok
            </a>
      
            <a class="navbar-item">
              Bahan Baku
            </a>
          </div>
      
          <div class="navbar-end">
            <div class="navbar-item">
              <div class="buttons">
                <a class="button is-light">
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
