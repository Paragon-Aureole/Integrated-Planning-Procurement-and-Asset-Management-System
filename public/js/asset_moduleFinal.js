  $(document).ready(function () {
      var classifiedDataTable = $('#classifiedDatatable').DataTable({
          responsive: true,
          "lengthMenu": [
              [5, 10, 25, 50, -1],
              [5, 10, 25, 50, "All"]
          ],
      });

      var itemIcs = $('#itemIcs').DataTable({
        responsive: true,
        "lengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],
    });

      $('#distributedItemsDatatable').DataTable({
          responsive: true,
          "lengthMenu": [
              [5, 10, 25, 50, -1],
              [5, 10, 25, 50, "All"]
          ],
      });

      classifiedDataTable.on('click', 'button#distributeItems', function () {
          console.log('CLICKED');

          var rowData = classifiedDataTable.row($(this).parents('tr')).data();

          toggleModalBody(rowData);

      });

      // show hide toggle for par and ics
      function toggleModalBody(rowData) {
          if (rowData[3] == 'PAR') {
              $('#parInputs').show();
              $('#icsInputs').hide();
              $('#assetType').text('PAR');
              populateParIcsInput('par', rowData);
          } else if (rowData[3] == 'ICS') {
              $('#icsInputs').show();
              $('#parInputs').hide();
              $('#assetType').text('ICS');
              populateParIcsInput('ics', rowData);

          }
      }

      function populateParIcsInput(type, selectedRow) {
          if (type == 'par') {
              clearModalFields().done(function () {
                  console.log(selectedRow);
                  getAssetData(selectedRow[0]).then(function (itemData) {
                      //  console.log(itemData.assetData[0]);

                      fillModalFields(itemData.assetData[0], "par");

                  });
                  //  var itemData = assetData.find(function (v) {
                  //      return v.id == selectedRow[0];
                  //  });

                  //  console.log(itemData);
              });
          } else {
              clearModalFields().done(function () {
                  console.log(selectedRow);
                  getAssetData(selectedRow[0]).then(function (itemData) {
                      //  console.log(itemData.assetData[0]);

                      fillModalFields(itemData.assetData[0], "ics");

                  });
                  //  var itemData = assetData.find(function (v) {
                  //      return v.id == selectedRow[0];
                  //  });

                  //  console.log(itemData);
              });

          }
      }

      function getPARNo() {
          return new Promise(function (resolve) {
              $.ajax({

                  type: 'GET',
                  url: '/getPARNo',
                  success: function (data) {
                      console.log(data);
                      resolve(data);
                  }
              });
          });
      };

      function getICSNo() {
          return new Promise(function (resolve) {
              $.ajax({

                  type: 'GET',
                  url: '/getICSNo',
                  success: function (data) {
                      console.log(data);
                      resolve(data);
                  }
              });
          });
      };

      function getAssetData(asset_id) {
          var values = {
              asset_id: asset_id
          }
          return new Promise(function (resolve) {
              $.ajax({
                  data: values,
                  type: 'GET',
                  url: '/getAssetData',
                  success: function (data) {
                      console.log(data);
                      resolve(data);
                  }
              });
          });
      };

      function getClassifiedItemQtyNo(id) {
          return new Promise(function (resolve) {
              $.ajax({

                  type: 'GET',
                  url: '/getClassifiedItemQtyNo/' + id,
                  success: function (data) {
                      console.log(data);
                      resolve(data);
                  }
              });
          });
      };

      function clearModalFields() {
          var deferredObject = $.Deferred();
          $('[name=selectedItemName]').empty();
          $('[name=selectedItemQty]').empty();
          $('[name=selectedItemUnitCost]').empty();
          $('[name=selectedItemEmployeeName]').empty();
          $('[name=selectedItemEmployeePosition]').empty();
          $('[name=selectedItemPARNo]').empty();
          $('[name=selectedItemICSNo]').empty();
          $('[name=selectedItemDateAssigned]').empty();
          $('[name=selectedItemTotalAmount]').empty();
          $('[name=selectedItemDescription]').empty();
          deferredObject.resolve();
          return deferredObject.promise();
      }

      function fillModalFields(itemData, type) {
          if (type == 'par') {
              getPARNo().then(function (parNo) {
                  $('[name=currentItemID').val(itemData['id']);
                  // console.log(parNo);

                  //setting Date to Now
                  var now = new Date();
                  var day = ("0" + now.getDate()).slice(-2);
                  var month = ("0" + (now.getMonth() + 1)).slice(-2);
                  var today = now.getFullYear() + "-" + (month) + "-" + (day);
                  $('[name=selectedItemDateAssigned]').val(today);

                  getClassifiedItemQtyNo(itemData['id']).then(function (qtyData) {
                      $('#qtyValPar').val('');
                      $('#qtyValPar').val(qtyData);

                      $('#descriptionPar').empty();
                      for (var i = 1; i <= qtyData; i++) {

                          $('#descriptionPar').append('<label>Description:' + i + '</label><br><textarea name="selectedItemDescription[]" cols="30" rows="10"class="form-control form-control-sm"></textarea>')

                      }

                      fillQuantityDropdown(qtyData);
                      setTotalAmount();
                  })

                  var unitCost = parseFloat(itemData['amount']) / parseFloat(itemData['item_quantity']);
                  $('[name=selectedItemPARNo]').val(parseInt(parNo) + 1);
                  $('[name=selectedItemName]').val(itemData['details']);
                  $('[name=selectedItemUnitCost]').val(unitCost);

              });
          } else if (type == 'ics') {
              getICSNo().then(function (icsNo) {
                  $('[name=currentItemID').val(itemData['id']);
                  // console.log(parNo);

                  //setting Date to Now
                  var now = new Date();
                  var day = ("0" + now.getDate()).slice(-2);
                  var month = ("0" + (now.getMonth() + 1)).slice(-2);
                  var today = now.getFullYear() + "-" + (month) + "-" + (day);
                  $('[name=selectedItemDateAssigned]').val(today);

                  getClassifiedItemQtyNo(itemData['id']).then(function (qtyData) {
                      $('#qtyValPar').val('');
                      $('#qtyValPar').val(qtyData);
                      fillQuantityDropdown(qtyData);

                  })

                  $('[name=selectedItemICSNo]').val(parseInt(icsNo) + 1);
                  $('[name=selectedItemName]').val(itemData['details']);

              });
          }
      }

      function setTotalAmount() {

          var itemQty = parseInt($('[name=selectedItemQty]').val());
          var unitCost = parseFloat($('[name=selectedItemUnitCost]').val());
          var finalResult = calculateTotalAmount(itemQty, unitCost);
          $('[name=selectedItemTotalAmount]').val(finalResult);
      }

      function calculateTotalAmount(itemQty, unitCost) {
          var result = itemQty * unitCost;
          return result;
      }

      function fillQuantityDropdown(remainingItems) {
          console.log(remainingItems);

          var dropdown = $('[name=selectedItemQty]');
          dropdown.empty();
          for (let index = remainingItems; index >= 1; index--) {
              dropdown.append('<option value=' + index + '> ' + index + '</option>');
          }
      }

      //distribution submission ajax

      $('#distributionFormSubmit').on('click', function () {
          // console.log('clicking');
          //  e.preventDefault();
          var assetType = $('#assetType').text()
          if (assetType == 'PAR') {
              var itemData = [];

              var itemQty = $('#qtyValPar').val();
              var itemDescription = $('textarea[name="selectedItemDescription[]"]').map(function () {
                  return $(this).val();
              }).get();
              var itemEmployeeName = $('[name=selectedItemEmployeeName]:eq(0)').val();
              var itemEmployeePosition = $('[name=selectedItemEmployeePosition]:eq(0)').val();
              var itemID = $('[name=currentItemID]').val();
              var currentPARNo = $('[name=selectedItemPARNo]').val();

              itemData[0] = itemID;
              itemData[1] = itemQty;
              itemData[2] = itemDescription;
              itemData[3] = itemEmployeeName;
              itemData[4] = itemEmployeePosition;
              itemData[5] = currentPARNo;

              console.log(itemData);
              saveClassifiedAssetAssign(itemData, 'par');
          } else {
              var itemData = [];

              var itemQty = $('#selectedItemQtyIcs').val();
              var itemEstimatedUsefulLife = $('[name=selectedItemEstimatedUsefulLife]').val();
              var itemDescription = $('[name=selectedItemDescription]').val();
              var itemEmployeeName = $('[name=selectedItemEmployeeName]').val();
              var itemEmployeePosition = $('[name=selectedItemEmployeePosition]').val();
              var itemID = $('[name=currentItemID]').val();
              var currentICSNo = $('[name=selectedItemICSNo]').val();

              itemData[0] = itemID;
              itemData[1] = itemQty;
              itemData[2] = itemDescription;
              itemData[3] = itemEmployeeName;
              itemData[4] = itemEmployeePosition;
              itemData[5] = itemEstimatedUsefulLife;
              itemData[6] = currentICSNo;

              console.log(itemData);
              if (itemData[0] == "" || itemData[1] == "" || itemData[2] == "" || itemData[3] == "" || itemData[4] == "" || itemData[5] == "" || itemData[6] == "") {
                  console.log('fields missing');
                  alert('Some fields are incomplete, please recheck.');
              } else {
                  console.log('fields complete');
                  saveClassifiedAssetAssign(itemData);
              }

          }


           

      });

      function saveClassifiedAssetAssign(formData, type) {

          var formUrl;
          if (type == 'par') {
              formUrl = '/saveNewPar';
          } else {
              formUrl = '/saveNewIcs';
          }

          return new Promise(function (resolve) {
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              $.ajax({
                  data: {
                      data: formData
                  },
                  type: 'POST',
                  url: formUrl,
                  success: function (data) {
                      console.log(data);

                      if (type == 'par') {
                          getPARNo().then(function (parNo) {
                              $('[name=selectedItemPARNo]').val(parseInt(parNo) + 1);

                              getClassifiedItemQtyNo(formData[0]).then(function (qtyData) {
                                  if (qtyData == 0) {
                                      alert('Asset Fully Assigned.');
                                      setIsAssigned(formData[0]);
                                      console.log('fully assigned.');

                                  } else {
                                      fillQuantityDropdown(qtyData);
                                      setTotalAmount();
                                      alert('PAR Asset Assigned.');
                                  }
                              });
                          });
                      } else {
                          getICSNo().then(function (icsNo) {
                              $('[name=selectedItemICSNo]').val(parseInt(icsNo) + 1);

                              getClassifiedItemQtyNo(formData[0]).then(function (qtyData) {
                                  if (qtyData == 0) {
                                      alert('Asset Fully Assigned.');
                                      setIsAssigned(formData[0]);
                                      console.log('fully assigned.');

                                  } else {
                                      fillQuantityDropdown(qtyData);
                                      alert('ICS Asset Assigned.');
                                  }
                              });
                          });
                      }

                      // resolve($('#currentPARNo').val(parseInt(data) + 1));
                  },
                  error: function (data) {
                      console.log(data);

                      // console.log(response);
                  }
              });
          });

      }

      function setIsAssigned(id) {
          return new Promise(function (resolve) {
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              $.ajax({
                  data: {
                      asset_id: id
                  },
                  type: 'POST',
                  url: '/setAssetIsAssigned',
                  success: function (data) {
                      console.log(data);
                      window.location.reload();

                      // resolve($('#currentICSNo').val(parseInt(data) + 1));
                  },
                  error: function (data) {
                      console.log(data);

                      // console.log(response);
                  }
              });
          });
      }

      // fetching procured Asset PO id from Table
      ClassificationModal();

      function ClassificationModal() {
          var table = $('#availableDatatable').DataTable({
              responsive: true,
              "lengthMenu": [
                  [5, 10, 25, 50, -1],
                  [5, 10, 25, 50, "All"]
              ],
          });

          // onclick function for fetching
          $('#availableDatatable').on('click', 'button#classificationModalBtn', function () {
              var data = table.row($(this).parents('tr')).data();

              console.log(data[0]);

              // give fetched data to this function
              getClassifcationModalContent(data);

          });
      }

      // get data from controller using ajax 
      function getClassifcationModalContent(data) {
          // id that will fetch from controller
          var values = {
              po_id: data[0]
          }

          // ajax function
          $.ajax({
              url: '/getClassificationModalData',
              method: 'get',
              data: values,
              success: function (response) {
                  var ClassificationModalContent = response.ClassificationModalContent;
                  // give fetched data to this function
                  populateClassificationModal(ClassificationModalContent);
              },
              error: function (response) {
                  console.log(response);
              }
          })
      }

      $('#assetClassificationForm').on('submit', function (e) {
          e.preventDefault();
          var form = this;

          var voucherNo = $('[name=voucherNo]').val();
          if (voucherNo == "") {
              console.log('voucherNo Empty, Please fill.');

          } else {
              console.log('voucherNo filled.');
              form.submit();
          }
      });

      // get data then populate the modal dataTable
      function populateClassificationModal(ClassificationModalContent) {
          // populate PO Id
          $('#po_id').empty();

          //   console.log(ClassificationModalContent[0].purchase_order_id);
          console.log(ClassificationModalContent);

          $('#po_id').text(ClassificationModalContent[0].purchase_order_id);
          $('[name=po_id]').val(ClassificationModalContent[0].purchase_order_id);

          var classificationModalContentSorted = new Array;


          for (let index = 0; index < ClassificationModalContent.length; index++) {
              var details = "<input type='hidden' name='id[" + index + "]' value='" + ClassificationModalContent[index].id + "'>" + ClassificationModalContent[index].details;
              var amount = ClassificationModalContent[index].amount;
              var item_stock = ClassificationModalContent[index].item_stock;
              var isPAR = "<input type='radio' name=PARorICS[" + index + "] value='PAR'>";
              var isICS = "<input type='radio' name=PARorICS[" + index + "] value='ICS'>";
              var asset_type = '<select required name="asset_type[' + index + ']" class="custom-select"><option value="">None</option><option value="1">Vehicle</option><option value="2">Office Supplies</option><option value="3">Furniture and Fixture</option><option value="4">IT Equipments</option>'

              classificationModalContentSorted.push({
                  details,
                  amount,
                  item_stock,
                  isPAR,
                  isICS,
                  asset_type
              });
          }

          console.log(classificationModalContentSorted);
          // Populate DataTable
          table = $('#itemClassification').DataTable({
              destroy: true,
              "lengthMenu": [
                  [5, 10, 25, 50, -1],
                  [5, 10, 25, 50, "All"]
              ],
              data: classificationModalContentSorted,
              responsive: true,
              columns: [{
                      data: 'details'
                  },
                  {
                      data: 'amount'
                  },
                  {
                      data: 'item_stock'
                  },
                  {
                      data: 'isPAR'
                  },
                  {
                      data: 'isICS'
                  },
                  {
                      data: 'asset_type'
                  }

              ]
          });
      }

      $('#selectedItemQtyPar').on('change', function () {
          console.log('is changing PAR');
          var qtyData = $('#selectedItemQtyPar').val()
          console.log(qtyData);
          $('#descriptionPar').empty();
          $('#qtyValPar').val('');
          $('#qtyValPar').val(qtyData);
          for (var i = 1; i <= qtyData; i++) {
              $('#descriptionPar').append('<label>Description:' + i + '</label><br><textarea name="selectedItemDescription[]" cols="30" rows="10"class="form-control form-control-sm"></textarea><br>')
          }
          setTotalAmount();
      });

      classifiedDataTable.on('click', 'button#requestBtn', function () {
          var rowData = classifiedDataTable.row($(this).parents('tr')).data();
          console.log(rowData);

          $('#itemId').val(rowData[0]);
          $('#itemName').val(rowData[1]);
          $('#classifiedIcs').val('ICS');


      });

      classifiedDataTable.on('click', 'button#printBtnIcs', function () {
          var rowData = classifiedDataTable.row($(this).parents('tr')).data();
          console.log(rowData[0]);

          populatePrintIcs(rowData);

      });

      function populatePrintIcs(rowData) {
          console.log(rowData[0])
        var id = rowData[0];
          var values = {
            item_ics : id
        }
        console.log(values);
        

        $.ajax({
            url: '/printIcsData',
            method: 'get',
            data: values,
            success: function (response) {
               console.log(response.icsData);
               var tableContent = response.icsData;
               console.log(tableContent);
               
               populateTobePrinted(tableContent);
               
            },
            error: function (response) {
                console.log(response);
            }
        });
        
        function populateTobePrinted (tableContent) {
            console.log(tableContent);
            var table = $('#itemIcs').DataTable({
                destroy:true,
                data: tableContent,
                responsive:false,
                columns:[
                    {data:'assignedTo'},
                    {data:'description'},
                    {data:'position'},
                    {data:'quantity'},
                    {data:'useful_life'},
                    {
                        'data': null,
                        'defaultContent': '<button id="btnPrint" class="btn btn-sm btn-success"><i class="fas fa-print"></i></button>'
                    }
                ]
            })
    
            // on click functions of every button from the table
            table.on('click', 'button#btnPrint', function () {
                console.log("button update clicked");
                var data = table.row( $(this).parents('tr') ).data();
                console.log(data.id);
                
                window.open('printIcs/'+data.id, 'blank');
            })
        }
      }

  });