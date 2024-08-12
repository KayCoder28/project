import React from 'react';

function MenuAcc() {
  return (
    <div className="left-sidebar">
        <h2>Account</h2>
        <div className="panel-group category-products" id="accordian">{/*category-productsr*/}
          <div className="panel panel-default">
            <div className="panel-heading">
              <h4 className="panel-title"><a href="/account/update">Account</a></h4>
            </div>
          </div>
          <div className="panel panel-default">
            <div className="panel-heading">
              <h4 className="panel-title"><a href="/account/product/list">My product</a></h4>
            </div>
          </div>
          <div className="panel panel-default">
            <div className="panel-heading">
              <h4 className="panel-title"><a href="/account/product/add">Add product</a></h4>
            </div>
          </div>

          {/* <div className="panel panel-default">
            <div className="panel-heading">
              <h4 className="panel-title"><a href="/account/product/edit/:id">Edit product</a></h4>
            </div>
          </div> */}
        </div>{/*/category-products*/}
      </div>
  );
}
export default MenuAcc;
