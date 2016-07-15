default:
	./maketemp.py variables.csv DRUP-???.feature

alltemp:
	ls *.feature | xargs -n1 ./maketemp.py variables.csv

cleanfeat:
	rm DRUP-???.feature

cleantemp:
	rm DRUP-???-template.feature

clean:
	rm *.feature

move:
	mv *-template.feature ~/Testing-Automation/templates/

.PHONY: default alltemp cleanfeat cleantemp clean move
