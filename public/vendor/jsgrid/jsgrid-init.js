!function (document, window, $) {
	"use strict";
	var Site = window.Site;
	$(document).ready(function ($) {

	}),
		function () {
			$("#basicgrid").jsGrid({
				height: "500px",
				width: "100%",
				filtering: false,
				editing: !0,
				sorting: !0,
				paging: !0,
				autoload: !0,
				pageSize: 30,
				pageButtonCount: 1,
				deleteConfirm: "Do you really want to delete the client?",
				controller: db,
				fields: [{
					name: "Name",
					type: "text",
					width: 150,
					editing: false,
				}, {
					name: "Age",
					type: "number",
					width: 70
				}, {
					name: "Address",
					type: "text",
					width: 200
				}, {
					name: "Country",
					type: "select",
					items: db.countries,
					valueField: "Id",
					textField: "Name"
				}, {
					name: "Married",
					type: "checkbox",
					title: "Is Married",
					sorting: !1
				}, {
					type: "control"
				}]
			})
		}(),
		function () {
			$("#staticgrid").jsGrid({
				height: "500px",
				width: "100%",
				sorting: !0,
				paging: !0,
				data: db.clients,
				fields: [{
					name: "Name",
					type: "text",
					width: 150
				}, {
					name: "Age",
					type: "number",
					width: 70
				}, {
					name: "Address",
					type: "text",
					width: 200
				}, {
					name: "Country",
					type: "select",
					items: db.countries,
					valueField: "Id",
					textField: "Name"
				}, {
					name: "Married",
					type: "checkbox",
					title: "Is Married"
				}]
			})
		}(),

		function () {
			$("#exampleSorting").jsGrid({
				height: "500px",
				width: "100%",
				autoload: !0,
				selecting: !1,
				controller: db,
				fields: [{
					name: "Name",
					type: "text",
					width: 150
				}, {
					name: "Age",
					type: "number",
					width: 50
				}, {
					name: "Address",
					type: "text",
					width: 200
				}, {
					name: "Country",
					type: "select",
					items: db.countries,
					valueField: "Id",
					textField: "Name"
				}, {
					name: "Married",
					type: "checkbox",
					title: "Is Married"
				}]
			}), $("#sortingField").on("change", function () {
				var field = $(this).val();
				$("#exampleSorting").jsGrid("sort", field)
			})
		}(),

		function () {
			var MyDateField = function (config) {
				jsGrid.Field.call(this, config)
			};
			MyDateField.prototype = new jsGrid.Field({
				sorter: function (date1, date2) {
					return new Date(date1) - new Date(date2)
				},
				itemTemplate: function (value) {
					return new Date(value).toDateString()
				},
				insertTemplate: function () {
					if (!this.inserting) return "";
					var $result = this.insertControl = this._createTextBox();
					return $result
				},
				editTemplate: function (value) {
					if (!this.editing) return this.itemTemplate(value);
					var $result = this.editControl = this._createTextBox();
					return $result.val(value), $result
				},
				insertValue: function () {
					return this.insertControl.datepicker("getDate")
				},
				editValue: function () {
					return this.editControl.datepicker("getDate")
				},
				_createTextBox: function () {
					return $("<input>").attr("type", "text").addClass("form-control input-sm").datepicker({
						autoclose: !0
					})
				}
			}), jsGrid.fields.myDateField = MyDateField, $("#exampleCustomGridField").jsGrid({
				height: "500px",
				width: "100%",
				inserting: !0,
				editing: !0,
				sorting: !0,
				paging: !0,
				data: db.users,
				fields: [{
					name: "Account",
					width: 150,
					align: "center"
				}, {
					name: "Name",
					type: "text"
				}, {
					name: "RegisterDate",
					type: "myDateField",
					width: 100,
					align: "center"
				}, {
					type: "control",
					editButton: !1,
					modeSwitchButton: !1
				}]
			})
		}()
}(document, window, jQuery);
