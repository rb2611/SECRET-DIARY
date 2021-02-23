from django.db import models

# Create your models here.
class DiaryDetail(models.Model):
    username = models.TextField(max_length=50 , null=False)
    detail = models.TextField(null=True)
    img = models.ImageField(default="None")

    def __str__(self):
        return self.username