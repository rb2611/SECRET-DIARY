from django.contrib import admin
from django.urls import path , include
from django.conf import settings
from django.conf.urls.static import static
from diary import views

urlpatterns = [
    path('',views.index,name="Home"),
    path('login',views.loginUser,name="login"),
    path('logout',views.logoutUser,name="logout"),
    path('register',views.registerUser,name="register"),
]