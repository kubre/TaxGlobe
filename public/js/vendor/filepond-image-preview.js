/*!
 * FilePondPluginImagePreview 4.6.7
 * Licensed under MIT, https://opensource.org/licenses/MIT/
 * Please visit https://pqina.nl/filepond/ for details.
 */

/* eslint-disable */

!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):(e=e||self).FilePondPluginImagePreview=t()}(this,function(){"use strict";function e(e){this.wrapped=e}function t(t){var i,r;function a(i,r){try{var o=t[i](r),c=o.value,s=c instanceof e;Promise.resolve(s?c.wrapped:c).then(function(e){s?a("next",e):n(o.done?"return":"normal",e)},function(e){a("throw",e)})}catch(e){n("throw",e)}}function n(e,t){switch(e){case"return":i.resolve({value:t,done:!0});break;case"throw":i.reject(t);break;default:i.resolve({value:t,done:!1})}(i=i.next)?a(i.key,i.arg):r=null}this._invoke=function(e,t){return new Promise(function(n,o){var c={key:e,arg:t,resolve:n,reject:o,next:null};r?r=r.next=c:(i=r=c,a(e,t))})},"function"!=typeof t.return&&(this.return=void 0)}"function"==typeof Symbol&&Symbol.asyncIterator&&(t.prototype[Symbol.asyncIterator]=function(){return this}),t.prototype.next=function(e){return this._invoke("next",e)},t.prototype.throw=function(e){return this._invoke("throw",e)},t.prototype.return=function(e){return this._invoke("return",e)};function i(e,t){return r(e)||function(e,t){var i=[],r=!0,a=!1,n=void 0;try{for(var o,c=e[Symbol.iterator]();!(r=(o=c.next()).done)&&(i.push(o.value),!t||i.length!==t);r=!0);}catch(e){a=!0,n=e}finally{try{r||null==c.return||c.return()}finally{if(a)throw n}}return i}(e,t)||a()}function r(e){if(Array.isArray(e))return e}function a(){throw new TypeError("Invalid attempt to destructure non-iterable instance")}var n=function(e,t){return s(e.x*t,e.y*t)},o=function(e,t){return s(e.x+t.x,e.y+t.y)},c=function(e,t,i){var r=Math.cos(t),a=Math.sin(t),n=s(e.x-i.x,e.y-i.y);return s(i.x+r*n.x-a*n.y,i.y+a*n.x+r*n.y)},s=function(){return{x:arguments.length>0&&void 0!==arguments[0]?arguments[0]:0,y:arguments.length>1&&void 0!==arguments[1]?arguments[1]:0}},h=function(e,t){var i=arguments.length>2&&void 0!==arguments[2]?arguments[2]:1,r=arguments.length>3?arguments[3]:void 0;return"string"==typeof e?parseFloat(e)*i:"number"==typeof e?e*(r?t[r]:Math.min(t.width,t.height)):void 0},u=function(e){return null!=e},l=function(e,t){return Object.keys(t).forEach(function(i){return e.setAttribute(i,t[i])})},d=function(e,t){var i=document.createElementNS("http://www.w3.org/2000/svg",e);return t&&l(i,t),i},f={contain:"xMidYMid meet",cover:"xMidYMid slice"},g={left:"start",center:"middle",right:"end"},p=function(e){return function(t){return d(e,{id:t.id})}},m={image:function(e){var t=d("image",{id:e.id,"stroke-linecap":"round","stroke-linejoin":"round",opacity:"0"});return t.onload=function(){t.setAttribute("opacity",e.opacity||1)},t.setAttributeNS("http://www.w3.org/1999/xlink","xlink:href",e.src),t},rect:p("rect"),ellipse:p("ellipse"),text:p("text"),path:p("path"),line:function(e){var t=d("g",{id:e.id,"stroke-linecap":"round","stroke-linejoin":"round"}),i=d("line");t.appendChild(i);var r=d("path");t.appendChild(r);var a=d("path");return t.appendChild(a),t}},y={rect:function(e){return l(e,Object.assign({},e.rect,e.styles))},ellipse:function(e){var t=e.rect.x+.5*e.rect.width,i=e.rect.y+.5*e.rect.height,r=.5*e.rect.width,a=.5*e.rect.height;return l(e,Object.assign({cx:t,cy:i,rx:r,ry:a},e.styles))},image:function(e,t){l(e,Object.assign({},e.rect,e.styles,{preserveAspectRatio:f[t.fit]||"none"}))},text:function(e,t,i,r){var a=h(t.fontSize,i,r),n=t.fontFamily||"sans-serif",o=t.fontWeight||"normal",c=g[t.textAlign]||"start";l(e,Object.assign({},e.rect,e.styles,{"stroke-width":0,"font-weight":o,"font-size":a,"font-family":n,"text-anchor":c})),e.text!==t.text&&(e.text=t.text,e.textContent=t.text.length?t.text:" ")},path:function(e,t,i,r){var a;l(e,Object.assign({},e.styles,{fill:"none",d:(a=t.points.map(function(e){return{x:h(e.x,i,r,"width"),y:h(e.y,i,r,"height")}}),a.map(function(e,t){return"".concat(0===t?"M":"L"," ").concat(e.x," ").concat(e.y)}).join(" "))}))},line:function(e,t,i,r){l(e,Object.assign({},e.rect,e.styles,{fill:"none"}));var a=e.childNodes[0],u=e.childNodes[1],d=e.childNodes[2],f=e.rect,g={x:e.rect.x+e.rect.width,y:e.rect.y+e.rect.height};if(l(a,{x1:f.x,y1:f.y,x2:g.x,y2:g.y}),t.lineDecoration){u.style.display="none",d.style.display="none";var p=function(e){var t=Math.sqrt(e.x*e.x+e.y*e.y);return 0===t?{x:0,y:0}:s(e.x/t,e.y/t)}({x:g.x-f.x,y:g.y-f.y}),m=h(.05,i,r);if(-1!==t.lineDecoration.indexOf("arrow-begin")){var y=n(p,m),E=o(f,y),v=c(f,2,E),w=c(f,-2,E);l(u,{style:"display:block;",d:"M".concat(v.x,",").concat(v.y," L").concat(f.x,",").concat(f.y," L").concat(w.x,",").concat(w.y)})}if(-1!==t.lineDecoration.indexOf("arrow-end")){var _=n(p,-m),I=o(g,_),M=c(g,2,I),x=c(g,-2,I);l(d,{style:"display:block;",d:"M".concat(M.x,",").concat(M.y," L").concat(g.x,",").concat(g.y," L").concat(x.x,",").concat(x.y)})}}}},E=function(e,t,i,r,a){"path"!==t&&(e.rect=function(e,t){var i=arguments.length>2&&void 0!==arguments[2]?arguments[2]:1,r=h(e.x,t,i,"width")||h(e.left,t,i,"width"),a=h(e.y,t,i,"height")||h(e.top,t,i,"height"),n=h(e.width,t,i,"width"),o=h(e.height,t,i,"height"),c=h(e.right,t,i,"width"),s=h(e.bottom,t,i,"height");return u(a)||(a=u(o)&&u(s)?t.height-o-s:s),u(r)||(r=u(n)&&u(c)?t.width-n-c:c),u(n)||(n=u(r)&&u(c)?t.width-r-c:0),u(o)||(o=u(a)&&u(s)?t.height-a-s:0),{x:r||0,y:a||0,width:n||0,height:o||0}}(i,r,a)),e.styles=function(e,t,i){var r=e.borderStyle||e.lineStyle||"solid",a=e.backgroundColor||e.fontColor||"transparent",n=e.borderColor||e.lineColor||"transparent",o=h(e.borderWidth||e.lineWidth,t,i);return{"stroke-linecap":e.lineCap||"round","stroke-linejoin":e.lineJoin||"round","stroke-width":o||0,"stroke-dasharray":"string"==typeof r?"":r.map(function(e){return h(e,t,i)}).join(","),stroke:n,fill:a,opacity:e.opacity||1}}(i,r,a),y[t](e,i,r,a)},v=["x","y","left","top","right","bottom","width","height"],w=function(e){var t=i(e,2),r=t[0],a=t[1],n=a.points?{}:v.reduce(function(e,t){var i;return e[t]="string"==typeof(i=a[t])&&/%/.test(i)?parseFloat(i)/100:i,e},{});return[r,Object.assign({zIndex:0},a,n)]},_=function(e,t){return e[1].zIndex>t[1].zIndex?1:e[1].zIndex<t[1].zIndex?-1:0},I=function(e){return e.utils.createView({name:"image-preview-markup",tag:"svg",ignoreRect:!0,mixins:{apis:["width","height","crop","markup","resize","dirty"]},write:function(e){var t=e.root,r=e.props;if(r.dirty){var a=r.crop,n=r.resize,o=r.markup,c=r.width,s=r.height,h=a.width,u=a.height;if(n){var l=n.size,d=l&&l.width,f=l&&l.height,g=n.mode,p=n.upscale;d&&!f&&(f=d),f&&!d&&(d=f);var y=h<d&&u<f;if(!y||y&&p){var v,I=d/h,M=f/u;if("force"===g)h=d,u=f;else"cover"===g?v=Math.max(I,M):"contain"===g&&(v=Math.min(I,M)),h*=v,u*=v}}var x={width:c,height:s};t.element.setAttribute("width",x.width),t.element.setAttribute("height",x.height);var T=Math.min(c/h,s/u);t.element.innerHTML="";var A=t.query("GET_IMAGE_PREVIEW_MARKUP_FILTER");o.filter(A).map(w).sort(_).forEach(function(e){var r=i(e,2),a=r[0],n=r[1],o=function(e,t){return m[e](t)}(a,n);E(o,a,n,x,T),t.element.appendChild(o)})}}})},M=function(e,t){return{x:e,y:t}},x=function(e,t){return M(e.x-t.x,e.y-t.y)},T=function(e,t){return Math.sqrt(function(e,t){return function(e,t){return e.x*t.x+e.y*t.y}(x(e,t),x(e,t))}(e,t))},A=function(e,t){var i=e,r=t,a=1.5707963267948966-t,n=Math.sin(1.5707963267948966),o=Math.sin(r),c=Math.sin(a),s=Math.cos(a),h=i/n;return M(s*(h*o),s*(h*c))},R=function(e,t,i,r){var a=r.x>.5?1-r.x:r.x,n=r.y>.5?1-r.y:r.y,o=2*a*e.width,c=2*n*e.height,s=function(e,t){var i=e.width,r=e.height,a=A(i,t),n=A(r,t),o=M(e.x+Math.abs(a.x),e.y-Math.abs(a.y)),c=M(e.x+e.width+Math.abs(n.y),e.y+Math.abs(n.x)),s=M(e.x-Math.abs(n.y),e.y+e.height-Math.abs(n.x));return{width:T(o,c),height:T(o,s)}}(t,i);return Math.max(s.width/o,s.height/c)},P=function(e,t){var i=e.width,r=i*t;return r>e.height&&(i=(r=e.height)/t),{x:.5*(e.width-i),y:.5*(e.height-r),width:i,height:r}},C=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},i=t.zoom,r=t.rotation,a=t.center,n=t.aspectRatio;n||(n=e.height/e.width);var o=function(e,t){var i=arguments.length>2&&void 0!==arguments[2]?arguments[2]:1,r=e.height/e.width,a=t,n=1,o=r;o>a&&(n=(o=a)/r);var c=Math.max(1/n,a/o),s=e.width/(i*c*n);return{width:s,height:s*t}}(e,n,i),c={x:.5*o.width,y:.5*o.height},s={x:0,y:0,width:o.width,height:o.height,center:c},h=void 0===t.scaleToFit||t.scaleToFit,u=i*R(e,P(s,n),r,h?a:{x:.5,y:.5});return{widthFloat:o.width/u,heightFloat:o.height/u,width:Math.round(o.width/u),height:Math.round(o.height/u)}},k={type:"spring",stiffness:.5,damping:.45,mass:10},D=function(e){return e.utils.createView({name:"image-clip",tag:"div",ignoreRect:!0,mixins:{apis:["crop","markup","resize","width","height","dirty","background"],styles:["width","height","opacity"],animations:{opacity:{type:"tween",duration:250}}},didWriteView:function(e){var t=e.root,i=e.props;i.background&&(t.element.style.backgroundColor=i.background)},create:function(t){var i=t.root,r=t.props;i.ref.image=i.appendChildView(i.createChildView(function(e){return e.utils.createView({name:"image-canvas-wrapper",tag:"div",ignoreRect:!0,mixins:{apis:["crop","width","height"],styles:["originX","originY","translateX","translateY","scaleX","scaleY","rotateZ"],animations:{originX:k,originY:k,scaleX:k,scaleY:k,translateX:k,translateY:k,rotateZ:k}},create:function(t){var i=t.root,r=t.props;r.width=r.image.width,r.height=r.image.height,i.ref.bitmap=i.appendChildView(i.createChildView(function(e){return e.utils.createView({name:"image-bitmap",ignoreRect:!0,mixins:{styles:["scaleX","scaleY"]},create:function(e){var t=e.root,i=e.props;t.appendChild(i.image)}})}(e),{image:r.image}))},write:function(e){var t=e.root,i=e.props.crop.flip,r=t.ref.bitmap;r.scaleX=i.horizontal?-1:1,r.scaleY=i.vertical?-1:1}})}(e),Object.assign({},r))),i.ref.createMarkup=function(){i.ref.markup||(i.ref.markup=i.appendChildView(i.createChildView(I(e),Object.assign({},r))))},i.ref.destroyMarkup=function(){i.ref.markup&&(i.removeChildView(i.ref.markup),i.ref.markup=null)};var a=i.query("GET_IMAGE_PREVIEW_TRANSPARENCY_INDICATOR");null!==a&&(i.element.dataset.transparencyIndicator="grid"===a?a:"color")},write:function(e){var t=e.root,i=e.props,r=e.shouldOptimize,a=i.crop,n=i.markup,o=i.resize,c=i.dirty,s=i.width,h=i.height;t.ref.image.crop=a;var u={x:0,y:0,width:s,height:h,center:{x:.5*s,y:.5*h}},l={width:t.ref.image.width,height:t.ref.image.height},d={x:a.center.x*l.width,y:a.center.y*l.height},f={x:u.center.x-l.width*a.center.x,y:u.center.y-l.height*a.center.y},g=2*Math.PI+a.rotation%(2*Math.PI),p=a.aspectRatio||l.height/l.width,m=void 0===a.scaleToFit||a.scaleToFit,y=R(l,P(u,p),g,m?a.center:{x:.5,y:.5}),E=a.zoom*y;n&&n.length?(t.ref.createMarkup(),t.ref.markup.width=s,t.ref.markup.height=h,t.ref.markup.resize=o,t.ref.markup.dirty=c,t.ref.markup.markup=n,t.ref.markup.crop=C(l,a)):t.ref.markup&&t.ref.destroyMarkup();var v=t.ref.image;if(r)return v.originX=null,v.originY=null,v.translateX=null,v.translateY=null,v.rotateZ=null,v.scaleX=null,void(v.scaleY=null);v.originX=d.x,v.originY=d.y,v.translateX=f.x,v.translateY=f.y,v.rotateZ=g,v.scaleX=E,v.scaleY=E}})},G='<svg width="500" height="200" viewBox="0 0 500 200" preserveAspectRatio="none">\n    <defs>\n        <radialGradient id="gradient-__UID__" cx=".5" cy="1.25" r="1.15">\n            <stop offset=\'50%\' stop-color=\'#000000\'/>\n            <stop offset=\'56%\' stop-color=\'#0a0a0a\'/>\n            <stop offset=\'63%\' stop-color=\'#262626\'/>\n            <stop offset=\'69%\' stop-color=\'#4f4f4f\'/>\n            <stop offset=\'75%\' stop-color=\'#808080\'/>\n            <stop offset=\'81%\' stop-color=\'#b1b1b1\'/>\n            <stop offset=\'88%\' stop-color=\'#dadada\'/>\n            <stop offset=\'94%\' stop-color=\'#f6f6f6\'/>\n            <stop offset=\'100%\' stop-color=\'#ffffff\'/>\n        </radialGradient>\n        <mask id="mask-__UID__">\n            <rect x="0" y="0" width="500" height="200" fill="url(#gradient-__UID__)"></rect>\n        </mask>\n    </defs>\n    <rect x="0" width="500" height="200" fill="currentColor" mask="url(#mask-__UID__)"></rect>\n</svg>',V=0,O=function(){self.onmessage=function(e){createImageBitmap(e.data.message.file).then(function(t){self.postMessage({id:e.data.id,message:t},[t])})}},b=function(){self.onmessage=function(e){for(var t=e.data.message.imageData,i=e.data.message.colorMatrix,r=t.data,a=r.length,n=i[0],o=i[1],c=i[2],s=i[3],h=i[4],u=i[5],l=i[6],d=i[7],f=i[8],g=i[9],p=i[10],m=i[11],y=i[12],E=i[13],v=i[14],w=i[15],_=i[16],I=i[17],M=i[18],x=i[19],T=0,A=0,R=0,P=0,C=0;T<a;T+=4)A=r[T]/255,R=r[T+1]/255,P=r[T+2]/255,C=r[T+3]/255,r[T]=Math.max(0,Math.min(255*(A*n+R*o+P*c+C*s+h),255)),r[T+1]=Math.max(0,Math.min(255*(A*u+R*l+P*d+C*f+g),255)),r[T+2]=Math.max(0,Math.min(255*(A*p+R*m+P*y+C*E+v),255)),r[T+3]=Math.max(0,Math.min(255*(A*w+R*_+P*I+C*M+x),255));self.postMessage({id:e.data.id,message:t},[t.data.buffer])}},S={1:function(){return[1,0,0,1,0,0]},2:function(e){return[-1,0,0,1,e,0]},3:function(e,t){return[-1,0,0,-1,e,t]},4:function(e,t){return[1,0,0,-1,0,t]},5:function(){return[0,1,1,0,0,0]},6:function(e,t){return[0,1,-1,0,t,0]},7:function(e,t){return[0,-1,-1,0,t,e]},8:function(e){return[0,-1,1,0,0,e]}},L=function(e,t,i,r){t=Math.round(t),i=Math.round(i);var a=document.createElement("canvas");a.width=t,a.height=i;var n=a.getContext("2d");if(r>=5&&r<=8){var o=[i,t];t=o[0],i=o[1]}return function(e,t,i,r){-1!==r&&e.transform.apply(e,S[r](t,i))}(n,t,i,r),n.drawImage(e,0,0,t,i),a},N=function(e){return/^image/.test(e.type)&&!/svg/.test(e.type)},W=function(e){var t=Math.min(10/e.width,10/e.height),i=document.createElement("canvas"),r=i.getContext("2d"),a=i.width=Math.ceil(e.width*t),n=i.height=Math.ceil(e.height*t);r.drawImage(e,0,0,a,n);var o=null;try{o=r.getImageData(0,0,a,n).data}catch(e){return null}for(var c=o.length,s=0,h=0,u=0,l=0;l<c;l+=4)s+=o[l]*o[l],h+=o[l+1]*o[l+1],u+=o[l+2]*o[l+2];return{r:s=z(s,c),g:h=z(h,c),b:u=z(u,c)}},z=function(e,t){return Math.floor(Math.sqrt(e/(t/4)))},H=function(e){var t=e.utils.createView({name:"image-preview-overlay",tag:"div",ignoreRect:!0,create:function(e){var t=e.root,i=e.props;if(document.querySelector("base")){var r=window.location.href.replace(window.location.hash,"");G=G.replace(/url\(\#/g,"url("+r+"#")}V++,t.element.classList.add("filepond--image-preview-overlay-".concat(i.status)),t.element.innerHTML=G.replace(/__UID__/g,V)},mixins:{styles:["opacity"],animations:{opacity:{type:"spring",mass:25}}}}),i=function(e){return e.utils.createView({name:"image-preview",tag:"div",ignoreRect:!0,mixins:{apis:["image","crop","markup","resize","dirty","background"],styles:["translateY","scaleX","scaleY","opacity"],animations:{scaleX:k,scaleY:k,translateY:k,opacity:{type:"tween",duration:400}}},create:function(t){var i=t.root,r=t.props;i.ref.clip=i.appendChildView(i.createChildView(D(e),{id:r.id,image:r.image,crop:r.crop,markup:r.markup,resize:r.resize,dirty:r.dirty,background:r.background}))},write:function(e){var t=e.root,i=e.props,r=e.shouldOptimize,a=t.ref.clip,n=i.image,o=i.crop,c=i.markup,s=i.resize,h=i.dirty;if(a.crop=o,a.markup=c,a.resize=s,a.dirty=h,a.opacity=r?0:1,!r&&!t.rect.element.hidden){var u=n.height/n.width,l=o.aspectRatio||u,d=t.rect.inner.width,f=t.rect.inner.height,g=t.query("GET_IMAGE_PREVIEW_HEIGHT"),p=t.query("GET_IMAGE_PREVIEW_MIN_HEIGHT"),m=t.query("GET_IMAGE_PREVIEW_MAX_HEIGHT"),y=t.query("GET_PANEL_ASPECT_RATIO"),E=t.query("GET_ALLOW_MULTIPLE");y&&!E&&(g=d*y,l=y);var v=null!==g?g:Math.max(p,Math.min(d*l,m)),w=v/l;w>d&&(v=(w=d)*l),v>f&&(v=f,w=f/l),a.width=w,a.height=v}}})}(e),r=e.utils.createWorker,a=function(e,t,i){return new Promise(function(a){e.ref.imageData||(e.ref.imageData=i.getContext("2d").getImageData(0,0,i.width,i.height));var n=function(e){var t;try{t=new ImageData(e.width,e.height)}catch(i){t=document.createElement("canvas").getContext("2d").createImageData(e.width,e.height)}return t.data.set(new Uint8ClampedArray(e.data)),t}(e.ref.imageData);if(!t||20!==t.length)return i.getContext("2d").putImageData(n,0,0),a();var o=r(b);o.post({imageData:n,colorMatrix:t},function(e){i.getContext("2d").putImageData(e,0,0),o.terminate(),a()},[n.data.buffer])})},n=function(e){var t=e.root,r=e.props,a=e.image,n=r.id,o=t.query("GET_ITEM",{id:n});if(o){var c,s,h=o.getMetadata("crop")||{center:{x:.5,y:.5},flip:{horizontal:!1,vertical:!1},zoom:1,rotation:0,aspectRatio:null},u=t.query("GET_IMAGE_TRANSFORM_CANVAS_BACKGROUND_COLOR"),l=!1;t.query("GET_IMAGE_PREVIEW_MARKUP_SHOW")&&(c=o.getMetadata("markup")||[],s=o.getMetadata("resize"),l=!0);var d=t.appendChildView(t.createChildView(i,{id:n,image:a,crop:h,resize:s,markup:c,dirty:l,background:u,opacity:0,scaleX:1.15,scaleY:1.15,translateY:15}),t.childViews.length);t.ref.images.push(d),d.opacity=1,d.scaleX=1,d.scaleY=1,d.translateY=0,setTimeout(function(){t.dispatch("DID_IMAGE_PREVIEW_SHOW",{id:n})},250)}},o=function(e){var t=e.root;t.ref.overlayShadow.opacity=1,t.ref.overlayError.opacity=0,t.ref.overlaySuccess.opacity=0},c=function(e){var t=e.root;t.ref.overlayShadow.opacity=.25,t.ref.overlayError.opacity=1};return e.utils.createView({name:"image-preview-wrapper",create:function(e){var i=e.root;i.ref.images=[],i.ref.imageData=null,i.ref.imageViewBin=[],i.ref.overlayShadow=i.appendChildView(i.createChildView(t,{opacity:0,status:"idle"})),i.ref.overlaySuccess=i.appendChildView(i.createChildView(t,{opacity:0,status:"success"})),i.ref.overlayError=i.appendChildView(i.createChildView(t,{opacity:0,status:"failure"}))},styles:["height"],apis:["height"],destroy:function(e){e.root.ref.images.forEach(function(e){e.image.width=1,e.image.height=1})},didWriteView:function(e){e.root.ref.images.forEach(function(e){e.dirty=!1})},write:e.utils.createRoute({DID_IMAGE_PREVIEW_DRAW:function(e){var t=e.root,i=t.ref.images[t.ref.images.length-1];i.translateY=0,i.scaleX=1,i.scaleY=1,i.opacity=1},DID_IMAGE_PREVIEW_CONTAINER_CREATE:function(e){var t=e.root,i=e.props.id,r=t.query("GET_ITEM",i);if(r){var a,n,o,c=URL.createObjectURL(r.file);a=c,n=function(e,r){t.dispatch("DID_IMAGE_PREVIEW_CALCULATE_SIZE",{id:i,width:e,height:r})},(o=new Image).onload=function(){var e=o.naturalWidth,t=o.naturalHeight;o=null,n(e,t)},o.src=a}},DID_FINISH_CALCULATE_PREVIEWSIZE:function(e){var t=e.root,i=e.props,o=i.id,c=t.query("GET_ITEM",o);if(c){var s,h,u=URL.createObjectURL(c.file),l=function(){var e;(e=u,new Promise(function(t,i){var r=new Image;r.crossOrigin="Anonymous",r.onload=function(){t(r)},r.onerror=function(e){i(e)},r.src=e})).then(d)},d=function(e){URL.revokeObjectURL(u);var r=(c.getMetadata("exif")||{}).orientation||-1,o=e.width,s=e.height;if(o&&s){if(r>=5&&r<=8){var h=[s,o];o=h[0],s=h[1]}var l=Math.max(1,.75*window.devicePixelRatio),d=t.query("GET_IMAGE_PREVIEW_ZOOM_FACTOR")*l,f=s/o,g=t.rect.element.width,p=t.rect.element.height,m=g,y=m*f;f>1?y=(m=Math.min(o,g*d))*f:m=(y=Math.min(s,p*d))/f;var E=L(e,m,y,r),v=function(){var r=t.query("GET_IMAGE_PREVIEW_CALCULATE_AVERAGE_IMAGE_COLOR")?W(data):null;c.setMetadata("color",r,!0),"close"in e&&e.close(),t.ref.overlayShadow.opacity=1,n({root:t,props:i,image:E})},w=c.getMetadata("filter");w?a(t,w,E).then(v):v()}};if(s=c.file,!(((h=window.navigator.userAgent.match(/Firefox\/([0-9]+)\./))?parseInt(h[1]):null)<=58)&&"createImageBitmap"in window&&N(s)){var f=r(O);f.post({file:c.file},function(e){f.terminate(),e?d(e):l()})}else l()}},DID_UPDATE_ITEM_METADATA:function(e){var t=e.root,i=e.props,r=e.action;if(/crop|filter|markup|resize/.test(r.change.key)&&t.ref.images.length){var o=t.query("GET_ITEM",{id:i.id});if(o)if(/filter/.test(r.change.key)){var c=t.ref.images[t.ref.images.length-1];a(t,r.change.value,c.image)}else{if(/crop|markup|resize/.test(r.change.key)){var s=o.getMetadata("crop"),h=t.ref.images[t.ref.images.length-1];if(Math.abs(s.aspectRatio-h.crop.aspectRatio)>1e-5){var u=function(e){var t=e.root,i=t.ref.images.shift();return i.opacity=0,i.translateY=-15,t.ref.imageViewBin.push(i),i}({root:t});n({root:t,props:i,image:(l=u.image,(d=d||document.createElement("canvas")).width=l.width,d.height=l.height,d.getContext("2d").drawImage(l,0,0),d)})}else!function(e){var t=e.root,i=e.props,r=t.query("GET_ITEM",{id:i.id});if(r){var a=t.ref.images[t.ref.images.length-1];a.crop=r.getMetadata("crop"),a.background=t.query("GET_IMAGE_TRANSFORM_CANVAS_BACKGROUND_COLOR"),t.query("GET_IMAGE_PREVIEW_MARKUP_SHOW")&&(a.dirty=!0,a.resize=r.getMetadata("resize"),a.markup=r.getMetadata("markup"))}}({root:t,props:i})}var l,d}}},DID_THROW_ITEM_LOAD_ERROR:c,DID_THROW_ITEM_PROCESSING_ERROR:c,DID_THROW_ITEM_INVALID:c,DID_COMPLETE_ITEM_PROCESSING:function(e){var t=e.root;t.ref.overlayShadow.opacity=.25,t.ref.overlaySuccess.opacity=1},DID_START_ITEM_PROCESSING:o,DID_REVERT_ITEM_PROCESSING:o},function(e){var t=e.root,i=t.ref.imageViewBin.filter(function(e){return 0===e.opacity});t.ref.imageViewBin=t.ref.imageViewBin.filter(function(e){return e.opacity>0}),i.forEach(function(e){return function(e,t){e.removeChildView(t),t.image.width=1,t.image.height=1,t._destroy()}(t,e)}),i.length=0})})},q=function(e){var t=e.addFilter,i=e.utils,r=i.Type,a=i.createRoute,n=i.isFile,o=H(e);return t("CREATE_VIEW",function(e){var t=e.is,i=e.view,r=e.query;if(t("file")&&r("GET_ALLOW_IMAGE_PREVIEW")){var c=function(e){e.root.ref.shouldRescale=!0};i.registerWriter(a({DID_RESIZE_ROOT:c,DID_STOP_RESIZE:c,DID_LOAD_ITEM:function(e){var t=e.root,a=e.props.id,c=r("GET_ITEM",a);if(c&&n(c.file)&&!c.archived){var s=c.file;if(function(e){return/^image/.test(e.type)}(s)&&r("GET_IMAGE_PREVIEW_FILTER_ITEM")(c)){var h="createImageBitmap"in(window||{}),u=r("GET_IMAGE_PREVIEW_MAX_FILE_SIZE");if(!(!h&&u&&s.size>u)){t.ref.imagePreview=i.appendChildView(i.createChildView(o,{id:a}));var l=t.query("GET_IMAGE_PREVIEW_HEIGHT");l&&t.dispatch("DID_UPDATE_PANEL_HEIGHT",{id:c.id,height:l});var d=!h&&s.size>r("GET_IMAGE_PREVIEW_MAX_INSTANT_PREVIEW_FILE_SIZE");t.dispatch("DID_IMAGE_PREVIEW_CONTAINER_CREATE",{id:a},d)}}}},DID_IMAGE_PREVIEW_CALCULATE_SIZE:function(e){var t=e.root,i=e.action;t.ref.imageWidth=i.width,t.ref.imageHeight=i.height,t.ref.shouldRescale=!0,t.ref.shouldDrawPreview=!0,t.dispatch("KICK")},DID_UPDATE_ITEM_METADATA:function(e){var t=e.root;"crop"===e.action.change.key&&(t.ref.shouldRescale=!0)}},function(e){var t=e.root,i=e.props;t.ref.imagePreview&&(t.rect.element.hidden||(t.ref.shouldRescale&&(!function(e,t){if(e.ref.imagePreview){var i=t.id,r=e.query("GET_ITEM",{id:i});if(r){var a=e.query("GET_PANEL_ASPECT_RATIO"),n=e.query("GET_ITEM_PANEL_ASPECT_RATIO"),o=e.query("GET_IMAGE_PREVIEW_HEIGHT");if(!(a||n||o)){var c=e.ref,s=c.imageWidth,h=c.imageHeight;if(s&&h){var u=e.query("GET_IMAGE_PREVIEW_MIN_HEIGHT"),l=e.query("GET_IMAGE_PREVIEW_MAX_HEIGHT"),d=(r.getMetadata("exif")||{}).orientation||-1;if(d>=5&&d<=8){var f=[h,s];s=f[0],h=f[1]}if(!N(r.file)||e.query("GET_IMAGE_PREVIEW_UPSCALE")){var g=2048/s;s*=g,h*=g}var p=h/s,m=(r.getMetadata("crop")||{}).aspectRatio||p,y=Math.max(u,Math.min(h,l)),E=e.rect.element.width,v=Math.min(E*m,y);e.dispatch("DID_UPDATE_PANEL_HEIGHT",{id:r.id,height:v})}}}}}(t,i),t.ref.shouldRescale=!1),t.ref.shouldDrawPreview&&(requestAnimationFrame(function(){t.dispatch("DID_FINISH_CALCULATE_PREVIEWSIZE",{id:i.id})}),t.ref.shouldDrawPreview=!1)))}))}}),{options:{allowImagePreview:[!0,r.BOOLEAN],imagePreviewFilterItem:[function(){return!0},r.FUNCTION],imagePreviewHeight:[null,r.INT],imagePreviewMinHeight:[44,r.INT],imagePreviewMaxHeight:[256,r.INT],imagePreviewMaxFileSize:[null,r.INT],imagePreviewZoomFactor:[2,r.INT],imagePreviewUpscale:[!1,r.BOOLEAN],imagePreviewMaxInstantPreviewFileSize:[1e6,r.INT],imagePreviewTransparencyIndicator:[null,r.STRING],imagePreviewCalculateAverageImageColor:[!1,r.BOOLEAN],imagePreviewMarkupShow:[!0,r.BOOLEAN],imagePreviewMarkupFilter:[function(){return!0},r.FUNCTION]}}};return"undefined"!=typeof window&&void 0!==window.document&&document.dispatchEvent(new CustomEvent("FilePond:pluginloaded",{detail:q})),q});
