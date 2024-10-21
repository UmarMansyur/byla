@extends('pengguna.layouts.index')
@section('content')
<div class="header">
  <div class="tf-container">
    <div class="tf-statusbar d-flex justify-content-center align-items-center">
      <a href="#" class="back-btn"> <i class="icon-left"></i> </a>
      <h3>Scan QR</h3>
    </div>
  </div>
</div>
<div class="mt-5">
  <div class="wrapper-bill">
    <div class="archive-top">
      <span class="circle-box lg bg-blue">
        <svg width="59" height="60" viewBox="0 0 59 60" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M46.5788 40.3162C46.5653 40.0476 46.5382 39.7827 46.4984 39.5218C46.4386 39.1307 46.35 38.7488 46.2349 38.3787C45.6435 36.4773 44.35 34.8866 42.659 33.9048V24.9114V22.3045V19.2246C42.659 18.7317 42.2597 18.3324 41.7668 18.3324H36.2607V16.4971C36.2607 16.0352 35.8863 15.6608 35.4244 15.6608C34.9626 15.6608 34.5881 16.0352 34.5881 16.4971V18.3324H24.4124V16.4971C24.4124 16.0352 24.038 15.6608 23.5761 15.6608C23.1143 15.6608 22.7398 16.0352 22.7398 16.4971V18.3324H17.2332C16.7406 18.3324 16.341 18.7317 16.341 19.2246V22.3045V24.9119V43.7579V46.8378C16.341 47.3304 16.7404 47.7301 17.2332 47.7301H33.3755C34.779 49.0224 36.6521 49.8124 38.7104 49.8124C43.0615 49.8124 46.589 46.2852 46.589 41.9338V40.7216C46.589 40.5858 46.5856 40.4506 46.5788 40.3162Z"
            fill="#382B73"></path>
          <path
            d="M41.7668 46.0347H17.2332C16.7406 46.0347 16.341 45.6354 16.341 45.1425V20.6092C16.341 20.1166 16.7404 19.7169 17.2332 19.7169H41.7668C42.2594 19.7169 42.659 20.1163 42.659 20.6092V45.1425C42.6588 45.6354 42.2594 46.0347 41.7668 46.0347Z"
            fill="#D1D3D4"></path>
          <path
            d="M41.7668 42.9548H17.2332C16.7406 42.9548 16.341 42.5555 16.341 42.0626V17.529C16.341 17.0364 16.7404 16.6368 17.2332 16.6368H41.7668C42.2594 16.6368 42.659 17.0362 42.659 17.529V42.0626C42.6588 42.5552 42.2594 42.9548 41.7668 42.9548Z"
            fill="white"></path>
          <path d="M16.3412 23.2166H42.659V23.7462H16.3412V23.2166Z" fill="#D1D3D4"></path>
          <path
            d="M41.7668 16.6371H17.2332C16.7406 16.6371 16.341 17.0364 16.341 17.5293V23.2166H42.6588V17.529C42.6588 17.0364 42.2594 16.6371 41.7668 16.6371Z"
            fill="#1CAEE4"></path>
          <path d="M16.3412 21.683H42.659V23.2163H16.3412V21.683Z" fill="#009ADD"></path>
          <path
            d="M24.6909 19.3135C24.6909 19.9294 24.1915 20.4288 23.5756 20.4288C22.9597 20.4288 22.4606 19.9294 22.4606 19.3135C22.4606 18.6976 22.9597 18.1985 23.5756 18.1985C24.1915 18.1982 24.6909 18.6976 24.6909 19.3135Z"
            fill="#136DA0"></path>
          <path
            d="M36.5394 19.3135C36.5394 19.9294 36.0401 20.4288 35.4244 20.4288C34.8085 20.4288 34.3091 19.9294 34.3091 19.3135C34.3091 18.6976 34.8083 18.1985 35.4244 18.1985C36.0401 18.1982 36.5394 18.6976 36.5394 19.3135Z"
            fill="#136DA0"></path>
          <path
            d="M23.5756 13.9652C23.1137 13.9652 22.7393 14.3397 22.7393 14.8015V19.2994C22.7393 19.7613 23.1137 20.1357 23.5756 20.1357C24.0374 20.1357 24.4119 19.7613 24.4119 19.2994V14.8018C24.4121 14.3399 24.0377 13.9652 23.5756 13.9652Z"
            fill="white"></path>
          <path
            d="M23.5756 18.7976C23.1137 18.7976 22.7393 18.4232 22.7393 17.9613V19.2994C22.7393 19.7613 23.1137 20.1357 23.5756 20.1357C24.0374 20.1357 24.4119 19.7613 24.4119 19.2994V17.9613C24.4121 18.4232 24.0377 18.7976 23.5756 18.7976Z"
            fill="#D1D3D4"></path>
          <path
            d="M35.4244 13.9652C34.9626 13.9652 34.5881 14.3397 34.5881 14.8015V19.2994C34.5881 19.7613 34.9626 20.1357 35.4244 20.1357C35.8863 20.1357 36.2607 19.7613 36.2607 19.2994V14.8018C36.2607 14.3399 35.8863 13.9652 35.4244 13.9652Z"
            fill="white"></path>
          <path
            d="M35.4244 18.7976C34.9626 18.7976 34.5881 18.4232 34.5881 17.9613V19.2994C34.5881 19.7613 34.9626 20.1357 35.4244 20.1357C35.8863 20.1357 36.2607 19.7613 36.2607 19.2994V17.9613C36.2607 18.4232 35.8863 18.7976 35.4244 18.7976Z"
            fill="#D1D3D4"></path>
          <path
            d="M22.4821 29.8821H18.8595C18.6197 29.8821 18.4252 29.6876 18.4252 29.4478V25.8252C18.4252 25.5854 18.6197 25.3909 18.8595 25.3909H22.4821C22.7219 25.3909 22.9164 25.5854 22.9164 25.8252V29.4478C22.9164 29.6876 22.7221 29.8821 22.4821 29.8821Z"
            fill="#E6E7E8"></path>
          <path
            d="M28.2893 29.8821H24.6667C24.4269 29.8821 24.2324 29.6876 24.2324 29.4478V25.8252C24.2324 25.5854 24.4269 25.3909 24.6667 25.3909H28.2893C28.5291 25.3909 28.7235 25.5854 28.7235 25.8252V29.4478C28.7235 29.6876 28.5291 29.8821 28.2893 29.8821Z"
            fill="#E6E7E8"></path>
          <path
            d="M34.0964 29.8821H30.4738C30.234 29.8821 30.0396 29.6876 30.0396 29.4478V25.8252C30.0396 25.5854 30.234 25.3909 30.4738 25.3909H34.0964C34.3362 25.3909 34.5307 25.5854 34.5307 25.8252V29.4478C34.5304 29.6876 34.3362 29.8821 34.0964 29.8821Z"
            fill="#E6E7E8"></path>
          <path
            d="M39.9034 29.8821H36.2807C36.041 29.8821 35.8465 29.6876 35.8465 29.4478V25.8252C35.8465 25.5854 36.041 25.3909 36.2807 25.3909H39.9034C40.1431 25.3909 40.3376 25.5854 40.3376 25.8252V29.4478C40.3376 29.6876 40.1431 29.8821 39.9034 29.8821Z"
            fill="#E6E7E8"></path>
          <path
            d="M22.4821 35.5262H18.8595C18.6197 35.5262 18.4252 35.3317 18.4252 35.092V31.4693C18.4252 31.2296 18.6197 31.0351 18.8595 31.0351H22.4821C22.7219 31.0351 22.9164 31.2296 22.9164 31.4693V35.092C22.9164 35.332 22.7221 35.5262 22.4821 35.5262Z"
            fill="#E6E7E8"></path>
          <path
            d="M28.2893 35.5262H24.6667C24.4269 35.5262 24.2324 35.3317 24.2324 35.092V31.4693C24.2324 31.2296 24.4269 31.0351 24.6667 31.0351H28.2893C28.5291 31.0351 28.7235 31.2296 28.7235 31.4693V35.092C28.7235 35.332 28.5291 35.5262 28.2893 35.5262Z"
            fill="#1CAEE4"></path>
          <path
            d="M34.0964 35.5262H30.4738C30.234 35.5262 30.0396 35.3317 30.0396 35.092V31.4693C30.0396 31.2296 30.234 31.0351 30.4738 31.0351H34.0964C34.3362 31.0351 34.5307 31.2296 34.5307 31.4693V35.092C34.5304 35.332 34.3362 35.5262 34.0964 35.5262Z"
            fill="#E6E7E8"></path>
          <path
            d="M39.9034 35.5262H36.2807C36.041 35.5262 35.8465 35.3317 35.8465 35.092V31.4693C35.8465 31.2296 36.041 31.0351 36.2807 31.0351H39.9034C40.1431 31.0351 40.3376 31.2296 40.3376 31.4693V35.092C40.3376 35.332 40.1431 35.5262 39.9034 35.5262Z"
            fill="#E6E7E8"></path>
          <path
            d="M22.4821 41.1704H18.8595C18.6197 41.1704 18.4252 40.9759 18.4252 40.7361V37.1135C18.4252 36.8737 18.6197 36.6793 18.8595 36.6793H22.4821C22.7219 36.6793 22.9164 36.8737 22.9164 37.1135V40.7361C22.9164 40.9762 22.7221 41.1704 22.4821 41.1704Z"
            fill="#E6E7E8"></path>
          <path
            d="M28.2893 41.1704H24.6667C24.4269 41.1704 24.2324 40.9759 24.2324 40.7361V37.1135C24.2324 36.8737 24.4269 36.6793 24.6667 36.6793H28.2893C28.5291 36.6793 28.7235 36.8737 28.7235 37.1135V40.7361C28.7235 40.9762 28.5291 41.1704 28.2893 41.1704Z"
            fill="#E6E7E8"></path>
          <path
            d="M34.0964 41.1704H30.4738C30.234 41.1704 30.0396 40.9759 30.0396 40.7361V37.1135C30.0396 36.8737 30.234 36.6793 30.4738 36.6793H34.0964C34.3362 36.6793 34.5307 36.8737 34.5307 37.1135V40.7361C34.5304 40.9762 34.3362 41.1704 34.0964 41.1704Z"
            fill="#E6E7E8"></path>
          <path
            d="M39.9034 41.1704H36.2807C36.041 41.1704 35.8465 40.9759 35.8465 40.7361V37.1135C35.8465 36.8737 36.041 36.6793 36.2807 36.6793H39.9034C40.1431 36.6793 40.3376 36.8737 40.3376 37.1135V40.7361C40.3376 40.9762 40.1431 41.1704 39.9034 41.1704Z"
            fill="#E6E7E8"></path>
          <path
            d="M30.8318 40.2385C30.8318 44.5896 34.3592 48.1171 38.7104 48.1171C43.0615 48.1171 46.589 44.5899 46.589 40.2385V39.0263C46.589 34.6752 43.0618 31.1477 38.7104 31.1477C34.3592 31.1477 30.8318 34.675 30.8318 39.0263V40.2385Z"
            fill="#E7AD27"></path>
          <path
            d="M38.7104 46.9049C43.0616 46.9049 46.589 43.3776 46.589 39.0263C46.589 34.6751 43.0616 31.1477 38.7104 31.1477C34.3592 31.1477 30.8318 34.6751 30.8318 39.0263C30.8318 43.3776 34.3592 46.9049 38.7104 46.9049Z"
            fill="#FEDE3A"></path>
          <path
            d="M42.8794 43.2043C45.1867 40.897 45.1867 37.1563 42.8794 34.8491C40.5722 32.5419 36.8315 32.5419 34.5243 34.8491C32.217 37.1563 32.217 40.897 34.5243 43.2043C36.8315 45.5115 40.5722 45.5115 42.8794 43.2043Z"
            fill="#F7CB15"></path>
          <path
            d="M38.7104 33.5553C41.8998 33.5553 44.4921 36.0842 44.6082 39.2453C44.6108 39.1721 44.6193 39.1002 44.6193 39.0263C44.6193 35.7631 41.9739 33.1174 38.7104 33.1174C35.4469 33.1174 32.8015 35.7628 32.8015 39.0263C32.8015 39.1002 32.8097 39.1719 32.8127 39.2453C32.9287 36.0842 35.521 33.5553 38.7104 33.5553Z"
            fill="#E7AD27"></path>
          <path
            d="M41.1923 40.7778C41.1923 40.3952 41.116 40.0573 40.9656 39.7732C40.8155 39.4899 40.5893 39.2433 40.2938 39.0409C40.0153 38.85 39.5956 38.6606 39.0107 38.4623C38.39 38.2513 38.1042 38.0631 37.9734 37.9418C37.8782 37.8537 37.8138 37.7418 37.7785 37.604C37.7654 37.5526 37.7654 37.4964 37.7787 37.4451C37.8182 37.2906 37.8933 37.1622 38.0056 37.0569C38.187 36.8866 38.4466 36.804 38.7995 36.804C39.1357 36.804 39.389 36.9062 39.5743 37.1164C39.7714 37.34 39.8671 37.6454 39.8671 38.0496C39.8671 38.2472 40.0272 38.4075 40.225 38.4075H40.783C40.9807 38.4075 41.141 38.2474 41.141 38.0496C41.141 38.0334 41.1381 38.0195 41.1378 38.0033H41.141V37.6454C41.141 36.9404 40.9608 36.3669 40.6053 35.9409C40.357 35.6434 40.0395 35.4327 39.6571 35.3104C39.5101 35.2635 39.4106 35.1264 39.4106 34.9721V34.6531V34.6069C39.4106 34.4093 39.2505 34.2489 39.0526 34.2489H38.5743C38.3767 34.2489 38.2163 34.409 38.2163 34.6069V34.6531V34.9627C38.2163 35.1189 38.1149 35.2584 37.9652 35.3027C37.6019 35.4102 37.2934 35.5914 37.0439 35.8445C36.6644 36.2295 36.4721 36.7314 36.4721 37.3361C36.4721 37.4078 36.483 37.4737 36.4886 37.5424C36.4835 37.6086 36.4721 37.6713 36.4721 37.7403C36.4721 38.3162 36.6479 38.7965 36.995 39.1685C37.3256 39.5226 37.8623 39.8129 38.6261 40.0525C39.2686 40.275 39.5559 40.471 39.6837 40.5959C39.7622 40.6727 39.8191 40.7609 39.8567 40.8616C39.8891 40.9483 39.8862 41.045 39.8518 41.1307C39.8041 41.2491 39.7278 41.3516 39.6205 41.4429C39.4055 41.6255 39.1262 41.7141 38.7666 41.7141C38.3503 41.7141 38.0422 41.6114 37.8252 41.4002C37.6111 41.192 37.507 40.9009 37.507 40.5104C37.507 40.3128 37.3469 40.1525 37.149 40.1525H36.5864C36.3888 40.1525 36.2285 40.3128 36.2285 40.5104C36.2285 40.5267 36.2318 40.5405 36.2318 40.5567H36.2285V40.9147C36.2285 41.6238 36.436 42.1975 36.8451 42.6197C37.1301 42.9137 37.4956 43.1176 37.9361 43.229C38.0931 43.2687 38.2025 43.4114 38.2025 43.5734V43.8037V43.85C38.2025 44.0476 38.3626 44.2079 38.5605 44.2079H39.0342C39.2318 44.2079 39.3922 44.0478 39.3922 43.85V43.8037V43.5567C39.3922 43.3985 39.496 43.2576 39.6484 43.2152C40.0274 43.1096 40.3476 42.9299 40.6048 42.6778C40.9947 42.2954 41.1926 41.7921 41.1926 41.182C41.1926 41.0956 41.1875 41.0123 41.1797 40.9306C41.1824 40.8788 41.1923 40.8311 41.1923 40.7778Z"
            fill="#E7AD27"></path>
          <path
            d="M40.9656 39.7732C40.8155 39.4899 40.5893 39.2433 40.2938 39.0409C40.0153 38.85 39.5956 38.6606 39.0109 38.4623C38.3902 38.2513 38.1044 38.0631 37.9737 37.9418C37.8204 37.8001 37.746 37.5981 37.746 37.324C37.746 37.0365 37.831 36.8168 38.0059 36.6526C38.1873 36.4824 38.4469 36.3998 38.7998 36.3998C39.1359 36.3998 39.3895 36.502 39.5745 36.7122C39.7717 36.936 39.8673 37.2412 39.8673 37.6456C39.8673 37.8432 40.0274 38.0036 40.2253 38.0036H40.7833C40.9809 38.0036 41.1412 37.8432 41.1412 37.6456C41.1412 36.9406 40.961 36.3671 40.6055 35.9411C40.3573 35.6437 40.0398 35.433 39.6573 35.3107C39.5103 35.2637 39.4108 35.1266 39.4108 34.9723V34.6071C39.4108 34.4095 39.2505 34.2492 39.0528 34.2492H38.5745C38.3769 34.2492 38.2166 34.4093 38.2166 34.6071V34.9629C38.2166 35.1191 38.1151 35.2586 37.9654 35.3029C37.6021 35.4105 37.2936 35.5916 37.0441 35.8447C36.6646 36.2298 36.4723 36.7316 36.4723 37.3361C36.4723 37.912 36.6482 38.3923 36.9952 38.7643C37.3258 39.1184 37.8625 39.4085 38.6264 39.6483C39.2689 39.8708 39.5561 40.0668 39.684 40.192C39.8387 40.3436 39.9141 40.5383 39.9141 40.7873C39.9141 41.0646 39.8208 41.2729 39.6208 41.4429C39.4057 41.6255 39.1265 41.7141 38.7668 41.7141C38.3503 41.7141 38.0422 41.6114 37.8252 41.4005C37.6111 41.1922 37.507 40.9011 37.507 40.5104C37.507 40.3128 37.3469 40.1525 37.149 40.1525H36.5864C36.3888 40.1525 36.2285 40.3128 36.2285 40.5104C36.2285 41.2198 36.436 41.7933 36.8451 42.2154C37.1301 42.5095 37.4956 42.7134 37.9361 42.8248C38.0931 42.8645 38.2025 43.0072 38.2025 43.1692V43.4458C38.2025 43.6434 38.3626 43.8037 38.5605 43.8037H39.0342C39.2318 43.8037 39.3922 43.6434 39.3922 43.4458V43.1525C39.3922 42.9943 39.496 42.8534 39.6484 42.811C40.0274 42.7054 40.3478 42.5257 40.6048 42.2736C40.9947 41.8912 41.1926 41.3879 41.1926 40.7778C41.1923 40.3954 41.116 40.0573 40.9656 39.7732Z"
            fill="#D1D3D4"></path>
          <path
            d="M40.9656 39.3693C40.8155 39.0859 40.5893 38.8394 40.2938 38.6369C40.0153 38.446 39.5956 38.2567 39.0109 38.0583C38.3902 37.8474 38.1044 37.6592 37.9737 37.5378C37.8204 37.3962 37.746 37.1942 37.746 36.92C37.746 36.6325 37.831 36.4129 38.0059 36.2487C38.1873 36.0784 38.4469 35.9958 38.7998 35.9958C39.1359 35.9958 39.3895 36.098 39.5745 36.3083C39.7717 36.532 39.8673 36.8372 39.8673 37.2414C39.8673 37.439 40.0274 37.5994 40.2253 37.5994H40.7833C40.9809 37.5994 41.1412 37.4393 41.1412 37.2414C41.1412 36.5364 40.961 35.9629 40.6055 35.5369C40.3573 35.2395 40.0398 35.0288 39.6573 34.9062C39.5103 34.8592 39.4108 34.7222 39.4108 34.5679V34.2027C39.4108 34.0051 39.2505 33.8447 39.0528 33.8447H38.5745C38.3769 33.8447 38.2166 34.0048 38.2166 34.2027V34.5585C38.2166 34.7147 38.1151 34.8542 37.9654 34.8985C37.6021 35.006 37.2936 35.1872 37.0441 35.4403C36.6646 35.8253 36.4723 36.3271 36.4723 36.9319C36.4723 37.5078 36.6482 37.9881 36.9952 38.3601C37.3258 38.7141 37.8625 39.0043 38.6264 39.2441C39.2689 39.4666 39.5561 39.6626 39.684 39.7878C39.8387 39.9394 39.9141 40.1338 39.9141 40.3831C39.9141 40.6604 39.8208 40.8686 39.6208 41.0387C39.4057 41.2213 39.1265 41.3099 38.7668 41.3099C38.3503 41.3099 38.0422 41.2072 37.8252 40.9963C37.6111 40.788 37.507 40.4969 37.507 40.1062C37.507 39.9086 37.3469 39.7483 37.149 39.7483H36.5864C36.3888 39.7483 36.2285 39.9086 36.2285 40.1062C36.2285 40.8154 36.436 41.3891 36.8451 41.8112C37.1301 42.1053 37.4956 42.3092 37.9361 42.4206C38.0931 42.4603 38.2025 42.603 38.2025 42.765V43.0416C38.2025 43.2392 38.3626 43.3995 38.5605 43.3995H39.0342C39.2318 43.3995 39.3922 43.2392 39.3922 43.0416V42.7483C39.3922 42.5901 39.496 42.4492 39.6484 42.4068C40.0274 42.3012 40.3476 42.1215 40.6048 41.8694C40.9947 41.487 41.1926 40.9837 41.1926 40.3736C41.1923 39.9912 41.116 39.6534 40.9656 39.3693Z"
            fill="white"></path>
        </svg>

      </span>
      <h2 class="mt-5 fw_6">Silahkan Scan QR Code</h2>
      <p class="fw_4 mt-1">Scan QR Code yang tertera pada karcis</p>
    </div>
    <div class="dashed-line"></div>
    <div class="archive-bottom">
      <h2 class="text-center">TRANSAKSI</h2>
      <div class="d-flex justify-content-center mb-3">
        <img src="data:image/svg+xml;base64," alt="QR Code" class="img-fluid" style="max-width: 80%" id="qr-code">
      </div>
      <ul class="mt-3">
        <li class="list-info-bill" id="kode-transaksi">Kode Transaksi <span id="kode-transaksi-value"></span></li>
      </ul>

    </div>

  </div>
</div>
@endsection
@push('script')

<script>
  window.onload = function() {
    const qrCode = document.getElementById('qr-code');
    const dataJson = JSON.parse(sessionStorage.getItem('transaction'));
    if (!dataJson) {
      window.location.href = '/pengguna/transaction';
    }
    if(qrCode) {
      qrCode.src = `data:image/svg+xml;base64,${dataJson.qrcode}`;
      document.getElementById('kode-transaksi-value').innerText = `${dataJson.data.kode_transaksi}`;
    }

    Pusher.logToConsole = true;

    const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
      cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
    });

    const channel = pusher.subscribe('transaction');
    channel.bind('transaction-update', function(data) {
      if(data === 'success') {
        window.location.href = `/transaction/success?kode_transaksi=${dataJson.data.kode_transaksi}`;
      }
    });
}
</script>
@endpush