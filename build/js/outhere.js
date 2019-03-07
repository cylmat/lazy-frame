/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var number = 2;

var text = 'Mon texte';

function isitsum (a, b) {
     return a + b + 1;
};

var isit_sum = function  (a, b) {
     return a + b + 1;
};

module.exports = isit_sum;

export default { isitsum }