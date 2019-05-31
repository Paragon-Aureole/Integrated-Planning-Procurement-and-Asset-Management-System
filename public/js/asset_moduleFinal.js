  $(document).ready(function () {
      $('#classifiedDatatable').DataTable({
          responsive: true,
          "lengthMenu": [
              [5, 10, 25, 50, -1],
              [5, 10, 25, 50, "All"]
          ],
      });

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

  });