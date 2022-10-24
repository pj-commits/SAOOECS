<script>
          function loadEmployees() {
        return {
          search: "",
          pageNumber: 0,
          size: 10,
          total: "",
          myForData: sourceData,

          get filteredEmployees() {
            const start = this.pageNumber * this.size,
              end = start + this.size;

            if (this.search === "") {
              this.total = this.myForData.length;
              return this.myForData.slice(start, end);
            }

            //Return the total results of the filters
            this.total = this.myForData.filter((item) => {
              return item.employee_name
                .toLowerCase()
                .includes(this.search.toLowerCase());
            }).length;

            //Return the filtered data
            return this.myForData
              .filter((item) => {
                return item.employee_name
                  .toLowerCase()
                  .includes(this.search.toLowerCase());
              })
              .slice(start, end);
          },

          //Create array of all pages (for loop to display page numbers)
          pages() {
            return Array.from({
              length: Math.ceil(this.total / this.size),
            });
          },

          //Next Page
          nextPage() {
            this.pageNumber++;
          },

          //Previous Page
          prevPage() {
            this.pageNumber--;
          },

          //Total number of pages
          pageCount() {
            return Math.ceil(this.total / this.size);
          },

          //Return the start range of the paginated results
          startResults() {
            return this.pageNumber * this.size + 1;
          },

          //Return the end range of the paginated results
          endResults() {
            let resultsOnPage = (this.pageNumber + 1) * this.size;

            if (resultsOnPage <= this.total) {
              return resultsOnPage;
            }

            return this.total;
          },

          //Link to navigate to page
          viewPage(index) {
            this.pageNumber = index;
          },
        };
      }
    </script>