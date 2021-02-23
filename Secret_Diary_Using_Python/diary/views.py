from django.shortcuts import render , HttpResponse , redirect
from django.contrib.auth.models import User
from diary.models import DiaryDetail
from django.contrib.auth import authenticate , login , logout

# Create your views here.
def index(request):
    if request.user.is_anonymous:
        return redirect('/login')
    if request.method == "POST":
        detail = request.POST.get("detail")
        diary = DiaryDetail.objects.filter(username = request.user).update(detail = detail)
        diarydetail = DiaryDetail.objects.filter(username = request.user)
        return render(request,'Home.html',{ 'diarydetail' : diarydetail})
    diarydetail = DiaryDetail.objects.filter(username = request.user)
    return render(request,'Home.html',{ 'diarydetail' : diarydetail })

def loginUser(request):
    if request.method == "POST":
        username = request.POST.get("username")
        password = request.POST.get("password")
        user = authenticate(username = username , password = password)
        if user is not None:
            login(request,user)
            return redirect('/')
        else:
            return render(request,'LoginPage.html')
    else:
        return render(request,'LoginPage.html')

def logoutUser(request):
    logout(request)
    return redirect('/login')

def registerUser(request):
    if request.method == "POST":
        email = request.POST.get("email")
        username = request.POST.get("username")
        password = request.POST.get("password")
        confirmpassword = request.POST.get("confirmpassword")
        profilepic = request.FILES.get("profilepic")
        if password == confirmpassword:
            print("sucess")
            if User.objects.filter(username = username,email = email).exists():
                error ="Email and Username Taken"
                print("username taken")
                return render(request,'RegisterPage.html',{'error':error})
            elif User.objects.filter(username = username).exists():
                error ="Username Taken"
                print("username taken")
                return render(request,'RegisterPage.html',{'error':error})
            elif User.objects.filter(email = email).exists():
                error = "Email already registered"
                print("email taken")
                return render(request,'RegisterPage.html',{'error':error})
            else:
                user = User.objects.create_user( username = username, password = password, email = email)
                user.save()
                if profilepic:
                    diarydetail = DiaryDetail(username = username , img = profilepic)
                    diarydetail.save()
                else:
                    diarydetail = DiaryDetail(username = username)
                    diarydetail.save()
                login(request,user)
                print("User Created")
                return redirect('/')
        else:
            error = "Password does not match"
            return render(request,'LoginPage.html',{'error':error})
    else:
        return render(request,'LoginPage.html')

    