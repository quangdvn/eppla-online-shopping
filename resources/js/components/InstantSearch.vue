<template>
  <ais-instant-search :search-client="searchClient" index-name="products">
    <div class="search-results-container-algolia my-4">
      <div class="left">
        <h2>Search Results</h2>
        <ais-search-box placeholder="Filter your wishes products here ..." />
        <ais-stats></ais-stats>
        <br />
        <h2>Categories</h2>
        <ais-refinement-list attribute="categories" :sortBy="['name:asc']" />
      </div>

      <div class="right">
        <ais-hits>
          <div slot="item" slot-scope="{ item }">
            <a :href="`/shop/${item.slug}`">
              <div class="instantsearch-result">
                <div>
                  <img
                    :src="`/storage/${item.image}`"
                    alt="img"
                    class="algolia-thumb-result"
                  />
                </div>
                <div>
                  <div class="result-title">
                    <ais-highlight
                      attribute="name"
                      :hit="item"
                      highlightedTagName="mark"
                    />
                  </div>
                  <div class="result-details">
                    <ais-highlight
                      attribute="details"
                      :hit="item"
                      highlightedTagName="mark"
                    />
                  </div>
                  <div class="result-price">
                    ${{ (item.price / 100).toFixed(2) }}
                  </div>
                </div>
              </div>
            </a>
            <hr />
          </div>
        </ais-hits>
        <div id="pagination">
          <ais-pagination></ais-pagination>
        </div>
      </div>
    </div>
    <!-- end search-section -->
  </ais-instant-search>
</template>

<script>
import algoliasearch from "algoliasearch/lite";

export default {
  data() {
    return {
      searchClient: algoliasearch(
        "VGYGZLD5IE",
        "08ef944b22bafb7eda508b643fe26518"
      )
    };
  }
};
</script>

