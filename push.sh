
if [ -z "$1" ]
then
	a="fallback :-/"
else
	a="$1"
fi

git commit -am "$a $2 $3 $4 $5 $6 $7"

git push

date

