from googletrans import Translator

translator = Translator()
ans =translator.translate("sorry", dest='pt')

print(ans.text)