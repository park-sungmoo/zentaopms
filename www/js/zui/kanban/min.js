/*!
 * ZUI: ZUI Kanban View - v1.9.2 - 2021-09-08
 * http://openzui.com
 * GitHub: https://github.com/easysoft/zui.git 
 * Copyright (c) 2021 cnezsoft.com; Licensed MIT
 */
!function(a){"use strict";var n="zui.kanban",e="object"==typeof CSS&&CSS.supports("display","flex"),t=function(d,i){var o=this;o.name=n,o.$=a(d),o.options=i=a.extend({},t.DEFAULTS,this.$.data(),i),o.data=i.data||[],o.render(o.data);var r=function(n){if(i.onAction){var e=a(this);i.onAction(e.data("action"),e,n,o)}};if(o.$.on("click",".action",r).on("dblclick",".action-dbc",r),"auto"===i.droppable&&(i.droppable=!i.readonly),i.droppable){var s={selector:".kanban-item",target:'.kanban-lane-col:not([data-type="EMPTY"])',drop:function(a){"function"==typeof i.droppable?i.droppable(a):i.onAction&&i.onAction("dropItem",a.element,a,o)}};"object"==typeof i.droppable&&a.extend(s,i.droppable),o.$.droppable(s)}e&&i.useFlex||a(window).on("resize",function(){o.adjustSize()}),!i.useFlex&&e&&o.$.addClass("not-use-flex")};t.prototype.render=function(a){var n=this;a&&(n.data=a),n.data&&!Array.isArray(n.data)&&(n.data=[n.data]);var t=n.data||[];n.options.beforeRender&&n.options.beforeRender(n,t),n.$.toggleClass("kanban-readonly",!!n.options.readonly).toggleClass("kanban-no-lane-name",!!n.options.noLaneName),n.$.children(".kanban-board").addClass("kanban-expired");for(var d=0;d<t.length;++d)n.renderKanban(d);n.$.children(".kanban-expired").remove(),e&&n.options.useFlex||setTimeout(n.adjustSize.bind(this),200),n.options.onRender&&n.options.onRender(n)},t.prototype.renderKanban=function(n){if("number"==typeof n)n=this.data[n];else{var t=this.data.findIndex(function(a){return a.id===n.id});if(t>-1){var d=this.data[t];n=a.extend(d,n),this.data[t]=n}else this.data.push(n)}n.id||(n.id=a.zui.uuid());var i=this,o=i.$,r=o.children('.kanban-board[data-id="'+n.id+'"]');r.length?r.removeClass("kanban-expired"):(r=a('<div class="kanban-board" data-id="'+n.id+'"></div>').appendTo(o),e||r.addClass("no-flex")),i.renderKanbanHeader(n,r),r.children(".kanban-lane").addClass("kanban-expired");for(var s=n.lanes||[],l=0;l<s.length;++l)i.renderLane(s[l],n.columns,r);r.children(".kanban-expired").remove();for(var l=0;l<n.columns.length;++l){var c=n.columns[l].id,p=r.find('.kanban-lane-col[data-id="'+c+'"] > .kanban-lane-items > .kanban-item').length;r.find('.kanban-header-col[data-id="'+c+'"] > .title > .count').text(p||"")}i.adjustKanbanSize(n,r),i.options.onRenderKanban&&i.options.onRenderKanban(r,n,i)},t.prototype.renderKanbanHeader=function(n,t){var d=this;t=t||d.$.children('.kanban-board[data-id="'+n.id+'"]');var i=t.children(".kanban-header");i.length||(i=a('<div class="kanban-header"></div>').prependTo(t),e||i.addClass("clearfix")),i.children(".kanban-col").addClass("kanban-expired");for(var o=n.columns,r=0;r<o.length;++r)d.renderHeaderCol(o[r],i);this.options.readonly||d.renderHeaderCol({id:"ADD",kanban:n.id,name:d.options.createColumnText,icon:"plus",type:"ADD"},i),i.children(".kanban-expired").remove()},t.prototype.renderHeaderCol=function(n,e){var t=e.children('.kanban-header-col[data-id="'+n.id+'"]'),d="ADD"===n.id;if(t.length)t.removeClass("kanban-expired"),d&&t.appendTo(e);else{t=a(['<div class="kanban-col kanban-header-col" data-id="'+n.id+'">',"<"+(d?"a":"div")+' class="title">','<i class="icon"></i>','<span class="text"></span>','<span class="count"></span>',"</"+(d?"a":"div")+">","</div>"].join("")).appendTo(e),d?t.children(".title").addClass("action").attr("data-action","addCol"):(t.children(".title").addClass("action-dbc").attr("data-action","editCol"),this.options.readonly||t.append(['<div class="actions">','<button class="btn btn-link action" type="button" data-action="headerMore"><i class="icon icon-more-v"></i></button>',"</div>"].join("")));var i=this.options.minColumnWidth;i&&t.css("min-width",i)}t.data("col",n),t.attr("data-type",n.type),t.find(".title>.icon").attr("class","icon icon-"+(n.icon||"")),t.find(".title>.text").text(n.name),t.find(".title>.count").text(n.count||""),this.options.onRenderHeaderCol&&this.options.onRenderHeaderCol(t,n,e)},t.prototype.renderLane=function(n,t,d){var i=this;d=d||i.$.children('.kanban-board[data-id="'+n.kanban+'"]');var o=d.children('.kanban-lane[data-id="'+n.id+'"]');if(o.length?o.removeClass("kanban-expired"):(o=a('<div class="kanban-lane" data-id="'+n.id+'"></div>').appendTo(d),e||o.addClass("clearfix")),o.data("lane",n),!i.options.noLaneName){var r=o.children('.kanban-lane-name[data-id="'+n.id+'"]');r.length||(r=a('<div class="kanban-lane-name action-dbc" data-action="editLaneName" data-id="'+n.id+'"></div>').appendTo(o));for(var s=[],l=0;l<n.name.length;++l){if(l>15){s.push('<span class="char rotate-90">…</span>');break}s.push('<span class="char">'+n.name[l]+"</span>")}r.toggleClass("is-arab",/^[\da-zA-Z ]+$/.test(n.name)).attr("title",n.name).html('<span class="text">'+s.join("")+"</span>"),n.color&&r.css("background-color",n.color),i.options.onRenderLaneName&&i.options.onRenderLaneName(r,n,d,t)}o.children(".kanban-col,.kanban-sub-lanes").addClass("kanban-expired"),n.subLanes?i.renderSubLanes(n,t,o):i.renderLaneItems(t,n.items,o),i.options.readonly||i.renderLaneCol({id:"EMPTY",type:"EMPTY"},o),o.children(".kanban-expired").remove()},t.prototype.renderSubLanes=function(n,e,t){var d=this,i=t.children('.kanban-sub-lanes[data-id="'+n.id+'"]');i.length?i.removeClass("kanban-expired"):i=a('<div class="kanban-sub-lanes" data-id="'+n.id+'"></div>').appendTo(t),i.children(".kanban-sub-lane").addClass("kanban-expired");for(var o=0;o<n.subLanes.length;++o){var r=n.subLanes[o];d.renderSubLane(r,e,i)}i.children(".kanban-expired").remove()},t.prototype.renderSubLane=function(n,t,d){var i=d.children('.kanban-sub-lane[data-id="'+n.id+'"]');i.length?i.removeClass("kanban-expired"):(i=a('<div class="kanban-sub-lane" data-id="'+n.id+'"></div>').appendTo(d),e||i.addClass("clearfix")),i.children(".kanban-col").addClass("kanban-expired"),this.renderLaneItems(t,n.items,i),i.children(".kanban-expired").remove()},t.prototype.renderLaneItems=function(a,n,e){for(var t=this,d=0;d<a.length;++d){var i=a[d],o=t.renderLaneCol(i,e),r=n[i.type]||[];t.renderColumnItems(i,r,o)}},t.prototype.renderColumnItems=function(a,n,e){var t=e.find(".kanban-lane-items");t.children(".kanban-item").addClass("kanban-expired");for(var d=0;d<n.length;++d){var i=n[d];this.renderLaneItem(i,t,a)}t.children(".kanban-expired").remove()},t.prototype.renderLaneCol=function(n,e){var t=this,d=e.children('.kanban-lane-col[data-id="'+n.id+'"]');if(d.length)d.removeClass("kanban-expired");else{d=a('<div class="kanban-col kanban-lane-col" data-id="'+n.id+'"></div>').appendTo(e),"EMPTY"!==n.id&&(d.append('<div class="kanban-lane-items"></div>'),t.options.readonly||d.append(['<div class="kanban-lane-actions">','<button class="btn btn-default btn-block action" type="button" data-action="addItem"><span class="text-muted"><i class="icon icon-plus"></i> '+t.options.addItemText+"</span></button>","</div>"].join("")));var i=t.options;i.minColumnWidth&&d.css("min-width",i.minColumnWidth),i.maxColHeight&&d.find(".kanban-lane-items").css("max-height",i.maxColHeight),i.laneItemsClass&&d.find(".kanban-lane-items").addClass(i.laneItemsClass),i.laneColClass&&d.addClass(i.laneColClass)}return"EMPTY"===n.id&&d.appendTo(e),d.attr("data-type",n.type),d},t.prototype.renderLaneItem=function(n,e,t){var d=e.children('.kanban-item[data-id="'+n.id+'"]');if(d.length?d.removeClass("kanban-expired"):d=a('<div class="kanban-item" data-id="'+n.id+'"></div>').appendTo(e),this.options.itemRender)this.options.itemRender(n,d,t);else{var i=d.find(".title");i.length||(i=a('<div class="title"></div>').appendTo(d)),i.text(n.name||n.title)}return d},t.prototype.adjustKanbanSize=function(n,t){var d=this,i=d.options.noLaneName?0:d.options.laneNameWidth,o=n.columns.length+(d.options.readonly?0:1),r=d.options.minColumnWidth*o+i;if(t=t||d.$.children('.kanban-board[data-id="'+n.id+'"]'),t.css({minWidth:r}),!d.options.useFlex||!e){var s=Math.max(r,d.$.width()),l=Math.floor((s-i)/o);t.find(".kanban-col").css("width",l),t.children(".kanban-lane").each(function(){var n=a(this),e=n.height();n.children(".kanban-col").css("height",e)})}},t.prototype.adjustSize=function(){for(var a=0;a<this.data.length;++a)this.adjustKanbanSize(this.data[a])},t.DEFAULTS={minColumnWidth:100,maxColHeight:400,laneNameWidth:20,addItemText:"添加条目",createColumnText:"添加看板列",useFlex:!0,itemRender:null,droppable:"auto",readonly:!1,laneColClass:"",noLaneName:!1},a.fn.kanban=function(e){return this.each(function(){var d=a(this),i=d.data(n),o="object"==typeof e&&e;i||d.data(n,i=new t(this,o)),"string"==typeof e&&i[e]()})},t.NAME=n,a.fn.kanban.Constructor=t}(jQuery);